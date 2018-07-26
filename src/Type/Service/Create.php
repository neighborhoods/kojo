<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Type\Service;

use Neighborhoods\Kojo\Type;

class Create extends Type\ServiceAbstract implements CreateInterface
{
    public function _save(): CreateInterface
    {
        $this->getDataJobType()->save();

        return $this;
    }

    public function setCode(string $code): CreateInterface
    {
        $this->getDataJobType()->setCode($code);

        return $this;
    }

    public function setWorkerClassUri(string $workerModelUri): CreateInterface
    {
        $this->getDataJobType()->setWorkerClassUri($workerModelUri);

        return $this;
    }

    public function setWorkerMethod(string $workerMethod): CreateInterface
    {
        $this->getDataJobType()->setWorkerMethod($workerMethod);

        return $this;
    }

    public function setName(string $name): CreateInterface
    {
        $this->getDataJobType()->setName($name);

        return $this;
    }

    public function setCronExpression(string $cronExpression): CreateInterface
    {
        $this->getDataJobType()->setCronExpression($cronExpression);

        return $this;
    }

    public function setCanWorkInParallel(bool $canWorkInParallel): CreateInterface
    {
        $this->getDataJobType()->setCanWorkInParallel($canWorkInParallel);

        return $this;
    }

    public function setDefaultImportance(int $defaultImportance): CreateInterface
    {
        $this->getDataJobType()->setDefaultImportance($defaultImportance);

        return $this;
    }

    public function setScheduleLimit(int $scheduleLimit): CreateInterface
    {
        $this->getDataJobType()->setScheduleLimit($scheduleLimit);

        return $this;
    }

    public function setScheduleLimitAllowance(int $scheduleLimitAllowance): CreateInterface
    {
        $this->getDataJobType()->setScheduleLimitAllowance($scheduleLimitAllowance);

        return $this;
    }

    public function setIsEnabled(bool $isEnabled): CreateInterface
    {
        $this->getDataJobType()->setIsEnabled($isEnabled);

        return $this;
    }

    public function setAutoCompleteSuccess(bool $autoCompleteSuccess): CreateInterface
    {
        $this->getDataJobType()->setAutoCompleteSuccess($autoCompleteSuccess);

        return $this;
    }

    public function setAutoDeleteIntervalDuration(string $autoDeleteIntervalDuration): CreateInterface
    {
        $this->getDataJobType()->setAutoDeleteIntervalDuration($autoDeleteIntervalDuration);

        return $this;
    }
}