<?php

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Db\Model;

class Type extends Model implements TypeInterface
{
    public function __construct()
    {
        $this->setTableName(TypeInterface::TABLE_NAME);
        $this->setIdPropertyName(TypeInterface::FIELD_NAME_ID);

        return $this;
    }

    public function setCode(string $code): TypeInterface
    {
        return $this;
    }

    public function getCode(): string
    {
    }

    public function setWorkerClassUri(string $workerModelUri): TypeInterface
    {
        return $this;
    }

    public function getWorkerUri(): string
    {
    }

    public function setWorkerMethod(string $workerMethod): TypeInterface
    {
        return $this;
    }

    public function getWorkerMethod(): string
    {
    }

    public function setName(string $name): TypeInterface
    {
        return $this;
    }

    public function getName(): string
    {
    }

    public function setCronExpression(string $cronExpression): TypeInterface
    {
        return $this;
    }

    public function getCronExpression(): string
    {
    }

    public function setCanWorkInParallel(bool $canWorkInParallel): TypeInterface
    {
        return $this;
    }

    public function getCanWorkInParallel(): bool
    {
    }

    public function setDefaultImportance(int $defaultImportance): TypeInterface
    {
        return $this;
    }

    public function getDefaultImportance(): int
    {
    }

    public function setScheduleLimit(int $scheduleLimit): TypeInterface
    {
        return $this;
    }

    public function getScheduleLimit(): int
    {
    }

    public function setIsEnabled(bool $isEnabled): TypeInterface
    {
        return $this;
    }

    public function getIsEnabled(): bool
    {
    }
}