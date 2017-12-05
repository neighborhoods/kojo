<?php

namespace NHDS\Jobs\Worker;

use NHDS\Jobs\Data\Job;
use NHDS\Jobs\Data\Property\Crud;
use NHDS\Jobs\Data\Job\State;
use NHDS\Jobs\Time;
use NHDS\Jobs\TimeInterface;
use NHDS\Jobs\Db;

class Service implements ServiceInterface
{
    use Db\Connection\Container\AwareTrait;
    use Time\AwareTrait;
    use Crud\AwareTrait;
    use Job\AwareTrait;
    protected $_saved;
    protected $_nextStateRequestUpdate;
    protected $_assignedStateUpdate;
    protected $_workAtDatetimeUpdate;
    protected $_statusService;

    public function getJobId(): int
    {
        return $this->_getJob()->getId();
    }

    public function getJobTypeCode(): string
    {
        return $this->_getJob()->getTypeCode();
    }

    public function didWorkerCrash(): bool
    {
        return ($this->_getJob()->getAssignedState() == State\ServiceInterface::STATE_CRASHED);
    }

    public function isRetry(): bool
    {
        return ($this->_getJob()->getAssignedState() == State\ServiceInterface::STATE_WAIT_RETRY);
    }

    public function getTimesRetried(): int
    {
        return $this->_getJob()->getTimesRetried();
    }

    public function retryJob(\DateTime $dateTime): ServiceInterface
    {
        $utc = $this->_getTime()->getDateTimeZone();
        $this->_workAtDatetimeUpdate = $dateTime->setTimezone($utc)->format(TimeInterface::MYSQL_DATETIME_FORMAT);
        $this->_nextStateRequestUpdate = State\ServiceInterface::STATE_WAIT_RETRY;
        $this->_assignedStateUpdate = State\ServiceInterface::STATE_WAIT;

        return $this;
    }

    public function holdJob(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = State\ServiceInterface::STATE_EMPTY;
        $this->_assignedStateUpdate = State\ServiceInterface::STATE_HOLD;

        return $this;
    }

    public function quitJob(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = State\ServiceInterface::STATE_EMPTY;
        $this->_assignedStateUpdate = State\ServiceInterface::STATE_COMPLETE_QUIT;

        return $this;
    }

    public function jobSucceeded(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = State\ServiceInterface::STATE_EMPTY;
        $this->_assignedStateUpdate = State\ServiceInterface::STATE_COMPLETE_SUCCESS;

        return $this;
    }

    public function jobFailed(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = State\ServiceInterface::STATE_EMPTY;
        $this->_assignedStateUpdate = State\ServiceInterface::STATE_COMPLETE_FAILED;

        return $this;
    }

    public function addError(string $message, string $code = ''): ServiceInterface
    {
        $this->_getJob()->getStatusService()->addError($message, $code);

        return $this;
    }

    public function addCritical(string $message, string $code = ''): ServiceInterface
    {
        $this->_getJob()->getStatusService()->addCritical($message, $code);

        return $this;
    }

    public function addInformation(string $message, string $code = ''): ServiceInterface
    {
        $this->_getJob()->getStatusService()->addInformation($message, $code);

        return $this;
    }

    public function save(): ServiceInterface
    {
        return $this;
    }

    public function rollback(): ServiceInterface
    {

        return $this;
    }
}