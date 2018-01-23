<?php
declare(strict_types=1);

namespace NHDS\Jobs;

use NHDS\Jobs\Data\Job;
use NHDS\Jobs\Message;
use NHDS\Jobs\Service\Update;
use NHDS\Jobs\Worker\Locator;
use NHDS\Jobs\Process\Pool\Logger;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Worker;

class Foreman implements ForemanInterface
{
    use Job\AwareTrait;
    use Message\Broker\AwareTrait;
    use Type\Repository\AwareTrait;
    use State\Service\AwareTrait;
    use Worker\Job\Service\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use Selector\AwareTrait;
    use Locator\AwareTrait;
    use Update\Work\Factory\AwareTrait;
    use Update\Panic\Factory\AwareTrait;
    use Update\Crash\Factory\AwareTrait;
    use Update\Complete\Success\Factory\AwareTrait;
    use Strict\AwareTrait;
    use Logger\AwareTrait;

    public function work(): ForemanInterface
    {
        if ($this->_getSelector()->hasWorkableJob()) {
            $this->_workWorker();
        }

        return $this;
    }

    protected function _workWorker(): ForemanInterface
    {
        $job = $this->_getSelector()->getWorkableJob();
        $this->setJob($job);
        $this->_getLocator()->setJob($job);
        if (is_callable($this->_getLocator()->getCallable())) {
            try{
                $updateWork = $this->_getServiceUpdateWorkFactory()->create();
                $updateWork->setJob($job);
                $updateWork->save();
            }catch(\Exception $exception){
                $updatePanic = $this->_getServiceUpdatePanicFactory()->create();
                $updatePanic->setJob($job);
                $updatePanic->save();
                $jobSemaphoreResource = $this->_getNewJobOwnerResource($job);
                $this->_getSemaphore()->releaseLock($jobSemaphoreResource);
                throw $exception;
            }
            try{
                $this->_getLogger()->debug('Instantiating Worker for Job[' . $job->getId() . '].');
                call_user_func($this->_getLocator()->getCallable());
            }catch(\Exception $exception){
                $updateCrash = $this->_getServiceUpdateCrashFactory()->create();
                $updateCrash->setJob($job);
                $updateCrash->save();
                throw $exception;
            }
            if ($this->_getJobType()->getAutoCompleteSuccess()) {
                $updateCompleteSuccess = $this->_getServiceUpdateCompleteSuccessFactory()->create();
                $updateCompleteSuccess->setJob($job);
                $updateCompleteSuccess->save();
            }else {
                $stateService = $this->_getStateServiceClone();
                $job->load();
                $stateService->setJob($job);
                if (!$this->_getWorkerJobService()->isRequestApplied() || !$stateService->isValidTransition()) {
                    $updateCrash = $this->_getServiceUpdateCrashFactory()->create();
                    $updateCrash->setJob($job);
                    $updateCrash->save();
                    $message = 'Worker related to Job with ID[' . $job->getId() . '] did not request a next state.';
                    throw new \LogicException($message);
                }
            }
        }else {
            $updatePanic = $this->_getServiceUpdatePanicFactory()->create();
            $updatePanic->setJob($job);
            $updatePanic->save();
            throw new \RuntimeException('Panicking Job[' . $job->getId() . '].');
        }
        $jobSemaphoreResource = $this->_getNewJobOwnerResource($job);
        $this->_getSemaphore()->releaseLock($jobSemaphoreResource);

        if (!$this->_getJobType()->getCanWorkInParallel()) {
            $this->_publishMessage();
        }

        return $this;
    }

    protected function _publishMessage()
    {
        $message = json_encode(['command' => "commandProcess.addProcess('job')"]);
        $this->_getMessageBroker()->publishMessage($message);
    }

    protected function _getJobType()
    {
        return $this->_getTypeRepository()->getJobType($this->_getJob()->getTypeCode());
    }
}