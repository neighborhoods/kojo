<?php

namespace NHDS\Jobs;

use NHDS\Jobs\Data\Job;
use NHDS\Jobs\Data\Job\Service\Update;
use NHDS\Jobs\Worker\Locator;
use NHDS\Jobs\Process\Pool\Logger;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Worker;

class Foreman implements ForemanInterface
{
    use Job\AwareTrait;
    use Job\Type\Repository\AwareTrait;
    use Job\State\Service\AwareTrait;
    use Worker\Job\Service\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use Job\Selector\AwareTrait;
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
        $job = $this->_getSelector()->getNextJobToWork();
        $this->_getLocator()->setJob($job);
        if (is_callable($this->_getLocator()->getCallable())) {
            try{
                $updateWork = $this->_getJobServiceUpdateWorkFactory()->create();
                $updateWork->setJob($job);
                $updateWork->save();
            }catch(\Exception $exception){
                $updatePanic = $this->_getJobServiceUpdatePanicFactory()->create();
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
                $updateCrash = $this->_getJobServiceUpdateCrashFactory()->create();
                $updateCrash->setJob($job);
                $updateCrash->save();
                throw new $exception;
            }
            if ($this->_getJobTypeRepository()->getJobType($job->getTypeCode())->getAutoCompleteSuccess()) {
                $updateCompleteSuccess = $this->_getUpdateCompleteSuccessFactory()->create();
                $updateCompleteSuccess->setJob($job);
                $updateCompleteSuccess->save();
            }else {
                $stateService = $this->_getJobStateServiceClone();
                $job->load();
                $stateService->setJob($job);
                if ($this->_getWorkerJobService()->applyRequest() && !$stateService->isValidTransition()) {
                    $updateCrash = $this->_getJobServiceUpdateCrashFactory()->create();
                    $updateCrash->setJob($job);
                    $updateCrash->save();
                    $message = 'Worker related to Job with ID[' . $job->getId() . '] did not request next state.';
                    throw new \LogicException($message);
                }
            }
        }else {
            $updatePanic = $this->_getJobServiceUpdatePanicFactory()->create();
            $updatePanic->setJob($job);
            $updatePanic->save();
            throw new \RuntimeException('Panicking Job[' . $job->getId() . '].');
        }
        $jobSemaphoreResource = $this->_getNewJobOwnerResource($job);
        $this->_getSemaphore()->releaseLock($jobSemaphoreResource);

        return $this;
    }
}