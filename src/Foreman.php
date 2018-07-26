<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Message;
use Neighborhoods\Kojo\Service\Update;
use Neighborhoods\Kojo\Worker\Locator;
use Neighborhoods\Kojo\Apm;

class Foreman implements ForemanInterface
{
    use Job\AwareTrait;
    use Message\Broker\AwareTrait;
    use Job\Type\Repository\AwareTrait;
    use State\Service\AwareTrait;
    use Api\V1\Worker\Service\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Owner\Job\Factory\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use Selector\AwareTrait;
    use Locator\AwareTrait;
    use Update\Work\Factory\AwareTrait;
    use Update\Panic\Factory\AwareTrait;
    use Update\Crash\Factory\AwareTrait;
    use Update\Complete\Success\Factory\AwareTrait;
    use Logger\AwareTrait;
    use Apm\NewRelic\AwareTrait;

    public function workWorker(): ForemanInterface
    {
        if ($this->getSelector()->hasWorkableJob()) {
            $this->_workWorker();
        }

        return $this;
    }

    protected function _workWorker(): ForemanInterface
    {
        $this->setJob($this->getSelector()->getWorkableJob());
        $this->getWorkerLocator()->setJob($this->getJob());
        try {
            $this->updateJobAsWorking();
            $this->runWorker();
            $this->updateJobAfterWork();
        } catch (Locator\Exception | \Error $throwable) {
            $this->panicJob();
            $jobId = $this->getJob()->getId();
            throw new \RuntimeException("Panicking job with ID[$jobId].", 0, $throwable);
        }
        $jobResourceOwner = $this->getSemaphoreResourceOwnerJobFactory()->create()->setJob($this->getJob());
        $semaphoreResource = $this->getSemaphoreResourceFactory()->create();
        $semaphoreResource->setSemaphoreResourceOwner($jobResourceOwner);
        $this->getSemaphore()->releaseLock($semaphoreResource);

        if (!$this->getJobType()->getCanWorkInParallel()) {
            $this->_publishMessage();
        }

        return $this;
    }

    protected function injectWorkerService(): ForemanInterface
    {
        $worker = $this->getWorkerLocator()->getClass();
        if (method_exists($worker, 'setApiV1WorkerService')) {
            $worker->setApiV1WorkerService($this->getApiV1WorkerService()->setJob($this->getJob()));
        }

        return $this;
    }

    protected function runWorker(): ForemanInterface
    {
        try {
            $className = $this->getWorkerLocator()->getClassName();
            $methodName = $this->getWorkerLocator()->getMethodName();
            $this->getApmNewRelic()->startTransaction();
            $this->getApmNewRelic()->nameTransaction($className . '::' . $methodName);
            $this->injectWorkerService();
            call_user_func($this->getWorkerLocator()->getCallable());
            $this->getApmNewRelic()->endTransaction();
        } catch (\Exception $throwable) {
            $this->crashJob();
            throw $throwable;
        }

        return $this;
    }

    protected function updateJobAsWorking(): ForemanInterface
    {
        try {
            $updateWork = $this->getServiceUpdateWorkFactory()->create();
            $updateWork->setJob($this->getJob());
            $updateWork->save();
        } catch (\Exception $exception) {
            $this->panicJob();
            $jobResourceOwner = $this->getSemaphoreResourceOwnerJobFactory()->create()->setJob($this->getJob());
            $semaphoreResource = $this->getSemaphoreResourceFactory()->create();
            $semaphoreResource->setSemaphoreResourceOwner($jobResourceOwner);
            $this->getSemaphore()->releaseLock($semaphoreResource);
            throw $exception;
        }

        return $this;
    }

    protected function updateJobAfterWork(): ForemanInterface
    {
        if ($this->getJobType()->getAutoCompleteSuccess()) {
            $updateCompleteSuccess = $this->getServiceUpdateCompleteSuccessFactory()->create();
            $updateCompleteSuccess->setJob($this->getJob());
            $updateCompleteSuccess->save();
        } else {
            if (!$this->getApiV1WorkerService()->isRequestApplied()) {
                $this->panicJob();
                $jobId = $this->getJob()->getId();
                throw new \LogicException("Worker related to job with ID[$jobId] did not request a next state.");
            }
        }

        return $this;
    }

    protected function _publishMessage(): ForemanInterface
    {
        $message = json_encode(['command' => "commandProcess.addProcess('job')"]);
        $this->getMessageBroker()->publishMessage($message);

        return $this;
    }

    protected function getJobType(): Job\TypeInterface
    {
        return $this->getJobTypeRepository()->get($this->getJob()->getTypeCode());
    }

    protected function panicJob(): ForemanInterface
    {
        $updatePanic = $this->getServiceUpdatePanicFactory()->create();
        $updatePanic->setJob($this->getJob());
        $updatePanic->save();

        return $this;
    }

    protected function crashJob(): ForemanInterface
    {
        $updateCrash = $this->getServiceUpdateCrashFactory()->create();
        $updateCrash->setJob($this->getJob());
        $updateCrash->save();

        return $this;
    }
}