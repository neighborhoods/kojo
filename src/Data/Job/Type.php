<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job;

use Cron\CronExpression;
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
        $this->_createPersistentProperty(TypeInterface::FIELD_NAME_TYPE_CODE, $code);

        return $this;
    }

    public function getCode(): string
    {
        return $this->_readPersistentProperty(TypeInterface::FIELD_NAME_TYPE_CODE);
    }

    public function setWorkerClassUri(string $workerModelUri): TypeInterface
    {
        $this->_createPersistentProperty(TypeInterface::FIELD_NAME_WORKER_URI, $workerModelUri);

        return $this;
    }

    public function getWorkerUri(): string
    {
        return $this->_readPersistentProperty(TypeInterface::FIELD_NAME_WORKER_URI);
    }

    public function setWorkerMethod(string $workerMethod): TypeInterface
    {
        $this->_createPersistentProperty(TypeInterface::FIELD_NAME_WORKER_METHOD, $workerMethod);

        return $this;
    }

    public function getWorkerMethod(): string
    {
        return $this->_readPersistentProperty(TypeInterface::FIELD_NAME_WORKER_METHOD);
    }

    public function setName(string $name): TypeInterface
    {
        $this->_createPersistentProperty(TypeInterface::FIELD_NAME_NAME, $name);

        return $this;
    }

    public function getName(): string
    {
        return $this->_readPersistentProperty(TypeInterface::FIELD_NAME_NAME);
    }

    public function setCronExpression(string $cronExpression): TypeInterface
    {
        CronExpression::factory($cronExpression);
        $this->_createPersistentProperty(TypeInterface::FIELD_NAME_CRON_EXPRESSION, $cronExpression);

        return $this;
    }

    public function getCronExpression(): string
    {
        return $this->_readPersistentProperty(TypeInterface::FIELD_NAME_CRON_EXPRESSION);
    }

    public function setCanWorkInParallel(bool $canWorkInParallel): TypeInterface
    {
        $this->_createPersistentProperty(TypeInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL, $canWorkInParallel);

        return $this;
    }

    public function getCanWorkInParallel(): bool
    {
        return (bool)$this->_readPersistentProperty(TypeInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL);
    }

    public function setDefaultImportance(int $defaultImportance): TypeInterface
    {
        $this->_createPersistentProperty(TypeInterface::FIELD_NAME_DEFAULT_IMPORTANCE, $defaultImportance);

        return $this;
    }

    public function getDefaultImportance(): int
    {
        return (int)$this->_readPersistentProperty(TypeInterface::FIELD_NAME_DEFAULT_IMPORTANCE);
    }

    public function setScheduleLimit(int $scheduleLimit): TypeInterface
    {
        if ($scheduleLimit < 0) {
            throw new \InvalidArgumentException('Schedule limit is less than zero.');
        };
        $this->_createPersistentProperty(TypeInterface::FIELD_NAME_SCHEDULE_LIMIT, $scheduleLimit);

        return $this;
    }

    public function getScheduleLimit(): int
    {
        return (int)$this->_readPersistentProperty(TypeInterface::FIELD_NAME_SCHEDULE_LIMIT);
    }

    public function setIsEnabled(bool $isEnabled): TypeInterface
    {
        $this->_createPersistentProperty(TypeInterface::FIELD_NAME_IS_ENABLED, $isEnabled);

        return $this;
    }

    public function getIsEnabled(): bool
    {
        return (bool)$this->_readPersistentProperty(TypeInterface::FIELD_NAME_IS_ENABLED);
    }

    public function setAutoCompleteSuccess(bool $autoCompleteSuccess): TypeInterface
    {
        $this->_createPersistentProperty(TypeInterface::FIELD_NAME_AUTO_COMPLETE_SUCCESS, $autoCompleteSuccess);

        return $this;
    }

    public function getAutoCompleteSuccess(): bool
    {
        return (bool)$this->_readPersistentProperty(TypeInterface::FIELD_NAME_AUTO_COMPLETE_SUCCESS);
    }

    public function setAutoDeleteIntervalDuration(string $autoDeleteIntervalDuration): TypeInterface
    {
        new \DateInterval($autoDeleteIntervalDuration);
        $this->_createPersistentProperty(
            TypeInterface::FIELD_NAME_AUTO_DELETE_INTERVAL_DURATION,
            $autoDeleteIntervalDuration
        );

        return $this;
    }

    public function getAutoDeleteIntervalDuration(): string
    {
        return $this->_readPersistentProperty(TypeInterface::FIELD_NAME_AUTO_DELETE_INTERVAL_DURATION);
    }
}