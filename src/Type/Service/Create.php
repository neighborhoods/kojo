<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Type\Service;

use Neighborhoods\Kojo\Type;
use Neighborhoods\Kojo\Data\Job;

class Create extends Type\ServiceAbstract implements CreateInterface
{
    /** @var Job\TypeInterface */
    protected $jobType;

    public function _save(): CreateInterface
    {
        $this->getJobType()->save();

        return $this;
    }

    public function setCode(string $code): CreateInterface
    {
        $this->getJobType()->setCode($code);

        return $this;
    }

    public function setWorkerClassUri(string $workerModelUri): CreateInterface
    {
        $this->getJobType()->setWorkerClassUri($workerModelUri);

        return $this;
    }

    public function setWorkerMethod(string $workerMethod): CreateInterface
    {
        $this->getJobType()->setWorkerMethod($workerMethod);

        return $this;
    }

    public function setName(string $name): CreateInterface
    {
        $this->getJobType()->setName($name);

        return $this;
    }

    public function setCronExpression(string $cronExpression): CreateInterface
    {
        $this->getJobType()->setCronExpression($cronExpression);

        return $this;
    }

    public function setCanWorkInParallel(bool $canWorkInParallel): CreateInterface
    {
        $this->getJobType()->setCanWorkInParallel($canWorkInParallel);

        return $this;
    }

    public function setDefaultImportance(int $defaultImportance): CreateInterface
    {
        $this->getJobType()->setDefaultImportance($defaultImportance);

        return $this;
    }

    public function setScheduleLimit(int $scheduleLimit): CreateInterface
    {
        $this->getJobType()->setScheduleLimit($scheduleLimit);

        return $this;
    }

    public function setScheduleLimitAllowance(int $scheduleLimitAllowance): CreateInterface
    {
        $this->getJobType()->setScheduleLimitAllowance($scheduleLimitAllowance);

        return $this;
    }

    public function setIsEnabled(bool $isEnabled): CreateInterface
    {
        $this->getJobType()->setIsEnabled($isEnabled);

        return $this;
    }

    public function setAutoCompleteSuccess(bool $autoCompleteSuccess): CreateInterface
    {
        $this->getJobType()->setAutoCompleteSuccess($autoCompleteSuccess);

        return $this;
    }

    public function setAutoDeleteIntervalDuration(string $autoDeleteIntervalDuration): CreateInterface
    {
        $this->getJobType()->setAutoDeleteIntervalDuration($autoDeleteIntervalDuration);

        return $this;
    }

    protected function getJobType() : Job\TypeInterface
    {
        if ($this->jobType === null) {
            $this->jobType = $this->_getJobTypeClone();
        }
        return $this->jobType;
    }
}
