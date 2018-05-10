<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example;

use Neighborhoods\Kojo\Api;
use Neighborhoods\Pylon\Data\Property;

class Worker implements WorkerInterface
{
    use Worker\Delegate\Repository\AwareTrait;
    use Api\V1\Worker\Service\AwareTrait;
    use Property\Defensive\AwareTrait;
    use Worker\Queue\AwareTrait;
    public const JOB_TYPE_CODE = 'type_code_1';

    public function work(): WorkerInterface
    {
        // Poll for first message.
        $this->_getWorkerQueue()->waitForNextMessage();

        // Schedule another job of the same type.
        $this->_scheduleNextJob();

        // Delegate the work for the first message.
        $this->_delegateWork();

        // Delegate the work until the observed Queue is empty.
        while ($this->_getWorkerQueue()->hasNextMessage()) {
            $this->_delegateWork();
        }

        // Tell Kōjō that we are done and all is well.
        $this->_getApiV1WorkerService()->requestCompleteSuccess()->applyRequest();

        // Fluent interfaces for the love of Pete.
        return $this;
    }

    protected function _delegateWork(): WorkerInterface
    {
        $workerDelegate = $this->_getWorkerDelegateRepository()->getNewWorkerDelegate();
        $workerDelegate->setWorkerQueueMessage($this->_getWorkerQueue()->getNextMessage());
        $workerDelegate->businessLogic();

        return $this;
    }

    protected function _scheduleNextJob(): WorkerInterface
    {
        $newJobScheduler = $this->_getApiV1WorkerService()->getNewJobScheduler();
        $newJobScheduler->setJobTypeCode(self::JOB_TYPE_CODE)
                        ->setWorkAtDateTime(new \DateTime('now'))
                        ->save()
                        ->getJobId();

        return $this;
    }
}