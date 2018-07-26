<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job;

use Cron\CronExpression;

class Type implements TypeInterface
{
    /** @var int */
    protected $kojo_job_type_id;
    /** @var string */
    protected $type_code;
    /** @var string */
    protected $name;
    /** @var string */
    protected $worker_uri;
    /** @var string */
    protected $worker_method;
    /** @var bool */
    protected $can_work_in_parallel;
    /** @var int */
    protected $default_importance;
    /** @var CronExpression */
    protected $cron_expression;
    /** @var int */
    protected $schedule_limit;
    /** @var int */
    protected $schedule_limit_allowance;
    /** @var bool */
    protected $is_enabled;
    /** @var bool */
    protected $auto_complete_success;
    /** @var \DateInterval */
    protected $auto_delete_interval_duration;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function getId(): int
    {
        if ($this->kojo_job_type_id === null) {
            throw new \LogicException('Type kojo_job_type_id has not been set.');
        }

        return $this->kojo_job_type_id;
    }

    public function setId(int $kojo_job_type_id): TypeInterface
    {
        if ($this->kojo_job_type_id !== null) {
            throw new \LogicException('Type kojo_job_type_id is already set.');
        }
        $this->kojo_job_type_id = $kojo_job_type_id;

        return $this;
    }

    public function getTypeCode(): string
    {
        if ($this->type_code === null) {
            throw new \LogicException('Type type_code has not been set.');
        }

        return $this->type_code;
    }

    public function setTypeCode(string $type_code): TypeInterface
    {
        if ($this->type_code !== null) {
            throw new \LogicException('Type type_code is already set.');
        }
        $this->type_code = $type_code;

        return $this;
    }

    public function getName(): string
    {
        if ($this->name === null) {
            throw new \LogicException('Type name has not been set.');
        }

        return $this->name;
    }

    public function setName(string $name): TypeInterface
    {
        if ($this->name !== null) {
            throw new \LogicException('Type name is already set.');
        }
        $this->name = $name;

        return $this;
    }

    public function getWorkerUri(): string
    {
        if ($this->worker_uri === null) {
            throw new \LogicException('Type worker_uri has not been set.');
        }

        return $this->worker_uri;
    }

    public function setWorkerUri(string $worker_uri): TypeInterface
    {
        if ($this->worker_uri !== null) {
            throw new \LogicException('Type worker_uri is already set.');
        }
        $this->worker_uri = $worker_uri;

        return $this;
    }

    public function getWorkerMethod(): string
    {
        if ($this->worker_method === null) {
            throw new \LogicException('Type worker_method has not been set.');
        }

        return $this->worker_method;
    }

    public function setWorkerMethod(string $worker_method): TypeInterface
    {
        if ($this->worker_method !== null) {
            throw new \LogicException('Type worker_method is already set.');
        }
        $this->worker_method = $worker_method;

        return $this;
    }

    public function getCanWorkInParallel(): bool
    {
        if ($this->can_work_in_parallel === null) {
            throw new \LogicException('Type can_work_in_parallel has not been set.');
        }

        return $this->can_work_in_parallel;
    }

    public function setCanWorkInParallel(bool $can_work_in_parallel): TypeInterface
    {
        if ($this->can_work_in_parallel !== null) {
            throw new \LogicException('Type can_work_in_parallel is already set.');
        }
        $this->can_work_in_parallel = $can_work_in_parallel;

        return $this;
    }

    public function getDefaultImportance(): int
    {
        if ($this->default_importance === null) {
            throw new \LogicException('Type default_importance has not been set.');
        }

        return $this->default_importance;
    }

    public function setDefaultImportance(int $default_importance): TypeInterface
    {
        if ($this->default_importance !== null) {
            throw new \LogicException('Type default_importance is already set.');
        }
        $this->default_importance = $default_importance;

        return $this;
    }

    public function getCronExpression(): CronExpression
    {
        if ($this->cron_expression === null) {
            throw new \LogicException('Type cron_expression has not been set.');
        }

        return $this->cron_expression;
    }

    public function setCronExpression(CronExpression $cron_expression): TypeInterface
    {
        if ($this->cron_expression !== null) {
            throw new \LogicException('Type cron_expression is already set.');
        }
        $this->cron_expression = $cron_expression;

        return $this;
    }

    public function getScheduleLimit(): int
    {
        if ($this->schedule_limit === null) {
            throw new \LogicException('Type schedule_limit has not been set.');
        }

        return $this->schedule_limit;
    }

    public function setScheduleLimit(int $schedule_limit): TypeInterface
    {
        if ($this->schedule_limit !== null) {
            throw new \LogicException('Type schedule_limit is already set.');
        }
        $this->schedule_limit = $schedule_limit;

        return $this;
    }

    public function getScheduleLimitAllowance(): int
    {
        if ($this->schedule_limit_allowance === null) {
            throw new \LogicException('Type schedule_limit_allowance has not been set.');
        }

        return $this->schedule_limit_allowance;
    }

    public function setScheduleLimitAllowance(int $schedule_limit_allowance): TypeInterface
    {
        if ($this->schedule_limit_allowance !== null) {
            throw new \LogicException('Type schedule_limit_allowance is already set.');
        }
        $this->schedule_limit_allowance = $schedule_limit_allowance;

        return $this;
    }

    public function getIsEnabled(): bool
    {
        if ($this->is_enabled === null) {
            throw new \LogicException('Type is_enabled has not been set.');
        }

        return $this->is_enabled;
    }

    public function setIsEnabled(bool $is_enabled): TypeInterface
    {
        if ($this->is_enabled !== null) {
            throw new \LogicException('Type is_enabled is already set.');
        }
        $this->is_enabled = $is_enabled;

        return $this;
    }

    public function getAutoCompleteSuccess(): bool
    {
        if ($this->auto_complete_success === null) {
            throw new \LogicException('Type auto_complete_success has not been set.');
        }

        return $this->auto_complete_success;
    }

    public function setAutoCompleteSuccess(bool $auto_complete_success): TypeInterface
    {
        if ($this->auto_complete_success !== null) {
            throw new \LogicException('Type auto_complete_success is already set.');
        }
        $this->auto_complete_success = $auto_complete_success;

        return $this;
    }

    public function getAutoDeleteIntervalDuration(): \DateInterval
    {
        if ($this->auto_delete_interval_duration === null) {
            throw new \LogicException('Type auto_delete_interval_duration has not been set.');
        }

        return $this->auto_delete_interval_duration;
    }

    public function setAutoDeleteIntervalDuration(\DateInterval $auto_delete_interval_duration): TypeInterface
    {
        if ($this->auto_delete_interval_duration !== null) {
            throw new \LogicException('Type auto_delete_interval_duration is already set.');
        }
        $this->auto_delete_interval_duration = $auto_delete_interval_duration;

        return $this;
    }
}