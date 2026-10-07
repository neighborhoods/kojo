<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Data\Job;
use Neighborhoods\Kojo\Doctrine;
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
    use Update\Complete\Success\Factory\AwareTrait;
    use Defensive\AwareTrait;
    use Logger\AwareTrait;
    use Logger\Message\Metadata\Builder\AwareTrait;
    use Api\V1\RDBMS\Connection\Service\AwareTrait;
    use Doctrine\Connection\Decorator\Repository\AwareTrait;

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
        try {
            $this->getProcessPoolLoggerMessageMetadataBuilder()->setJob($this->_getJob());
            $this->_updateJobAsWorking();
            restore_error_handler();
            $this->_runWorker();
            set_error_handler(new ErrorHandler());
            $this->_updateJobAfterWork();
        } catch (\Throwable $throwable) {
            set_error_handler(new ErrorHandler());
            $this->_panicJob();
            $jobId = $this->_getJob()->getId();
            // exiting with nonzero code will give the Root's SIGCHLD handler some info
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
            $worker->setApiV1WorkerService($this->getApiV1WorkerService()->setJob($this->_getJob()));
        }

        return $this;
    }

    protected function _injectRDBMSConnectionService(): ForemanInterface
    {
        $worker = $this->_getLocator()->getClass();
        if (method_exists($worker, 'setApiV1RDBMSConnectionService')) {
            $worker->setApiV1RDBMSConnectionService($this->getApiV1RDBMSConnectionService());
        }

        return $this;
    }

    protected function _runWorker(): ForemanInterface
    {
        $this->_injectWorkerService();
        $this->_injectRDBMSConnectionService();
        call_user_func($this->_getLocator()->getCallable());

        return $this;
    }

    protected function _updateJobAsWorking(): ForemanInterface
    {
        try {
            $updateWork = $this->_getServiceUpdateWorkFactory()->create();
            $updateWork->setJob($this->_getJob());
            $updateWork->save();
        } catch (\Throwable $throwable) {
            $this->_panicJob();
            $this->_getSemaphore()->releaseLock($this->_getNewJobOwnerResource($this->_getJob()));
            throw $throwable;
        }

        return $this;
    }

    protected function _updateJobAfterWork(): ForemanInterface
    {
        /** @var \PDO $pdo */
        $pdo = $this
            ->_getDoctrineConnectionDecoratorRepository()
            ->get(Doctrine\Connection\DecoratorInterface::ID_JOB) // Kojo's decorator of doctrine's connection object
            ->getDoctrineConnection() // doctrine's connection object
            ->getWrappedConnection(); // the internal PDO of doctrine's connection object

        if ($pdo->inTransaction()) {
            $pdo->rollBack();
            $this->_panicJob();
            $jobId = $this->_getJob()->getId();
            throw new \LogicException("Worker related to job with ID[$jobId] left a transaction open.");
        }

        if ($this->_getJobType()->getAutoCompleteSuccess()) {
            $updateCompleteSuccess = $this->_getServiceUpdateCompleteSuccessFactory()->create();
            $updateCompleteSuccess->setJob($this->_getJob());
            $updateCompleteSuccess->save();
        } else {
            if (!$this->getApiV1WorkerService()->isRequestApplied()) {
                $this->_panicJob();
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
}
