<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1;

use Neighborhoods\Kojo\Api;

class Worker implements WorkerInterface
{
    use Worker\Delegate\Repository\AwareTrait;
    use Api\V1\Worker\Service\AwareTrait;
    use Worker\Queue\AwareTrait;
    public const JOB_TYPE_CODE = 'protean_dlcp_example';

    public function work(): WorkerInterface
    {
        $this->fireEvent('new_worker');
        if ($this->getApiV1WorkerService()->getTimesCrashed() === 0) {
            // Wait for one message to become available.
            if($this->getV1WorkerQueue()->hasNextMessage()){
                $this->fireEvent('message_received');
                // Schedule another kōjō job of the same type.
                $this->_scheduleNextJob();

                // Delegate the work for the first message.
                $this->_delegateWork();

                // Delegate the work until the observed Queue is empty.
                while ($this->getV1WorkerQueue()->hasNextMessage()) {
                    $this->_delegateWork();
                }
            }
        }

        // Tell Kōjō that we are done and all is well.
        $this->fireEvent('complete_success');
        $this->getApiV1WorkerService()->requestCompleteSuccess()->applyRequest();

        // Fluent interfaces for the love of Pete.
        return $this;
    }

    protected function _delegateWork(): WorkerInterface
    {
        $workerDelegate = $this->getV1WorkerDelegateRepository()->getV1NewWorkerDelegate();
        $workerDelegate->setV1WorkerQueueMessage($this->getV1WorkerQueue()->getNextMessage());

        $this->fireEvent('working');
        if (extension_loaded('newrelic')) {
            newrelic_end_transaction();
            newrelic_start_transaction(ini_get("newrelic.appname")); // start recording a new transaction
            newrelic_name_transaction(self::JOB_TYPE_CODE);
        }

        $workerDelegate->businessLogic();

        return $this;
    }

    protected function _scheduleNextJob(): WorkerInterface
    {
        $this->fireEvent('schedule_next_job');
        $newJobScheduler = $this->getApiV1WorkerService()->getNewJobScheduler();
        $newJobScheduler->setJobTypeCode(self::JOB_TYPE_CODE)
            ->setWorkAtDateTime(new \DateTime('now'))
            ->save();

        return $this;
    }

    protected function fireEvent(string $event) : WorkerInterface
    {
        if (extension_loaded('newrelic')) {
            newrelic_record_custom_event($event, ['job_type' => self::JOB_TYPE_CODE]);
        }
        $this->getApiV1WorkerService()->getLogger()->info($event, ['job_type' => self::JOB_TYPE_CODE]);

        return $this;
    }
}
