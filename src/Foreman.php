<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Data\Job;
use Neighborhoods\Kojo\Message;
use Neighborhoods\Kojo\Service\Update;
use Neighborhoods\Kojo\Worker\Locator;
use Neighborhoods\Kojo\Process\Pool\Logger;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Foreman implements ForemanInterface
{
    use Job\AwareTrait;
    use Message\Broker\AwareTrait;
    use Type\Repository\AwareTrait;
    use State\Service\AwareTrait;
    use Api\V1\Worker\Service\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use Selector\AwareTrait;
    use Locator\AwareTrait;
    use Update\Work\Factory\AwareTrait;
    use Update\Panic\Factory\AwareTrait;
    use Update\Crash\Factory\AwareTrait;
    use Update\Complete\Success\Factory\AwareTrait;
    use Defensive\AwareTrait;
    use Logger\AwareTrait;

    public function workWorker(): ForemanInterface
    {
        if ($this->_getSelector()->hasWorkableJob()) {
            $this->_workWorker();
        }

        return $this;
    }

    protected function _workWorker(): ForemanInterface
    {
        $this->setJob($this->_getSelector()->getWorkableJob());
        $this->_getLocator()->setJob($this->_getJob());
        try{
            $this->_injectWorkerService();
            $this->_updateJobAsWorking();
            $this->_runWorker();
            $this->_updateJobAfterWork();
        }catch(Locator\Exception | \Error $throwable){
            $this->_panicJob();
            $jobId = $this->_getJob()->getId();
            throw new \RuntimeException("Panicking job with ID[$jobId].", 0, $throwable);
        }
        $this->_getSemaphore()->releaseLock($this->_getNewJobOwnerResource($this->_getJob()));

        if (!$this->_getJobType()->getCanWorkInParallel()) {
            $this->_publishMessage();
        }

        return $this;
    }

    protected function _injectWorkerService(): ForemanInterface
    {
        $worker = $this->_getLocator()->getClass();
        if (method_exists($worker, 'setApiV1WorkerService')) {
            $worker->setApiV1WorkerService($this->_getApiV1WorkerService());
        }

        return $this;
    }

    protected function _runWorker(): ForemanInterface
    {
        try{
            call_user_func($this->_getLocator()->getCallable());
        }catch(\Exception $throwable){
            $this->_crashJob();
            throw $throwable;
        }

        return $this;
    }

    protected function _updateJobAsWorking(): ForemanInterface
    {
        try{
            $updateWork = $this->_getServiceUpdateWorkFactory()->create();
            $updateWork->setJob($this->_getJob());
            $updateWork->save();
        }catch(\Exception $exception){
            $this->_panicJob();
            $this->_getSemaphore()->releaseLock($this->_getNewJobOwnerResource($this->_getJob()));
            throw $exception;
        }

        return $this;
    }

    protected function _updateJobAfterWork(): ForemanInterface
    {
        if ($this->_getJobType()->getAutoCompleteSuccess()) {
            $updateCompleteSuccess = $this->_getServiceUpdateCompleteSuccessFactory()->create();
            $updateCompleteSuccess->setJob($this->_getJob());
            $updateCompleteSuccess->save();
        }else {
            $stateService = $this->_getStateServiceClone();
            $this->_getJob()->load();
            $stateService->setJob($this->_getJob());
            if (!$this->_getApiV1WorkerService()->isRequestApplied() || !$stateService->isValidTransition()) {
                $this->_crashJob();
                $jobId = $this->_getJob()->getId();
                throw new \LogicException("Worker related to job with ID[$jobId] did not request a next state.");
            }
        }

        return $this;
    }

    protected function _publishMessage(): ForemanInterface
    {
        $message = json_encode(['command' => "commandProcess.addProcess('job')"]);
        $this->_getMessageBroker()->publishMessage($message);

        return $this;
    }

    protected function _getJobType(): Job\TypeInterface
    {
        return $this->_getTypeRepository()->getJobType($this->_getJob()->getTypeCode());
    }

    protected function _panicJob(): ForemanInterface
    {
        $updatePanic = $this->_getServiceUpdatePanicFactory()->create();
        $updatePanic->setJob($this->_getJob());
        $updatePanic->save();

        return $this;
    }

    protected function _crashJob(): ForemanInterface
    {
        $updateCrash = $this->_getServiceUpdateCrashFactory()->create();
        $updateCrash->setJob($this->_getJob());
        $updateCrash->save();

        return $this;
    }
}