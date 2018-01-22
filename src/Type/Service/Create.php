<?php
declare(strict_types=1);

namespace NHDS\Jobs\Type\Service;

use NHDS\Jobs\Type;

class Create extends Type\ServiceAbstract implements CreateInterface
{
    public function _save(): CreateInterface
    {
        $this->_getJobType()->save();

        return $this;
    }

    public function setCode(string $code): CreateInterface
    {
        $this->_getJobType()->setCode($code);

        return $this;
    }

    public function setWorkerClassUri(string $workerModelUri): CreateInterface
    {
        $this->_getJobType()->setWorkerClassUri($workerModelUri);

        return $this;
    }

    public function setWorkerMethod(string $workerMethod): CreateInterface
    {
        $this->_getJobType()->setWorkerMethod($workerMethod);

        return $this;
    }

    public function setName(string $name): CreateInterface
    {
        $this->_getJobType()->setName($name);

        return $this;
    }

    public function setCronExpression(string $cronExpression): CreateInterface
    {
        $this->_getJobType()->setCronExpression($cronExpression);

        return $this;
    }

    public function setCanWorkInParallel(bool $canWorkInParallel): CreateInterface
    {
        $this->_getJobType()->setCanWorkInParallel($canWorkInParallel);

        return $this;
    }

    public function setDefaultImportance(int $defaultImportance): CreateInterface
    {
        $this->_getJobType()->setDefaultImportance($defaultImportance);

        return $this;
    }

    public function setScheduleLimit(int $scheduleLimit): CreateInterface
    {
        $this->_getJobType()->setScheduleLimit($scheduleLimit);

        return $this;
    }

    public function setIsEnabled(bool $isEnabled): CreateInterface
    {
        $this->_getJobType()->setIsEnabled($isEnabled);

        return $this;
    }

    public function setAutoCompleteSuccess(bool $autoCompleteSuccess): CreateInterface
    {
        $this->_getJobType()->setAutoCompleteSuccess($autoCompleteSuccess);

        return $this;
    }

    public function setAutoDeleteIntervalDuration(string $autoDeleteIntervalDuration): CreateInterface
    {
        $this->_getJobType()->setAutoDeleteIntervalDuration($autoDeleteIntervalDuration);

        return $this;
    }
}