<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job;

use Cron\CronExpression;

interface TypeInterface extends \JsonSerializable
{
    public const TABLE_NAME = 'kojo_job_type';
    public const FIELD_NAME_ID = 'kojo_job_type_id';
    public const FIELD_NAME_TYPE_CODE = 'type_code';
    public const FIELD_NAME_NAME = 'name';
    public const FIELD_NAME_WORKER_URI = 'worker_uri';
    public const FIELD_NAME_WORKER_METHOD = 'worker_method';
    public const FIELD_NAME_CAN_WORK_IN_PARALLEL = 'can_work_in_parallel';
    public const FIELD_NAME_DEFAULT_IMPORTANCE = 'default_importance';
    public const FIELD_NAME_CRON_EXPRESSION = 'cron_expression';
    public const FIELD_NAME_SCHEDULE_LIMIT = 'schedule_limit';
    public const FIELD_NAME_SCHEDULE_LIMIT_ALLOWANCE = 'schedule_limit_allowance';
    public const FIELD_NAME_IS_ENABLED = 'is_enabled';
    public const FIELD_NAME_AUTO_COMPLETE_SUCCESS = 'auto_complete_success';
    public const FIELD_NAME_AUTO_DELETE_INTERVAL_DURATION = 'auto_delete_interval_duration';
    public const INDEX_NAME_SCHEDULER_COVERING = 'SCHEDULER_COVERING';
    public const INDEX_NAME_IS_ENABLED__CODE = 'is_enabled__code';

    public function setTypeCode(string $code): TypeInterface;

    public function getTypeCode(): string;

    public function setName(string $name): TypeInterface;

    public function getName(): string;

    public function setWorkerUri(string $workerUri): TypeInterface;

    public function getWorkerUri(): string;

    public function setWorkerMethod(string $workerMethod): TypeInterface;

    public function getWorkerMethod(): string;

    public function setCanWorkInParallel(bool $canWorkInParallel): TypeInterface;

    public function getCanWorkInParallel(): bool;

    public function setDefaultImportance(int $defaultImportance): TypeInterface;

    public function getDefaultImportance(): int;

    public function setCronExpression(CronExpression $cronExpression): TypeInterface;

    public function getCronExpression(): CronExpression;

    public function setScheduleLimit(int $scheduleLimit): TypeInterface;

    public function getScheduleLimit(): int;

    public function setIsEnabled(bool $isEnabled): TypeInterface;

    public function getIsEnabled(): bool;

    public function setAutoCompleteSuccess(bool $autoCompleteSuccess): TypeInterface;

    public function getAutoCompleteSuccess(): bool;

    public function setAutoDeleteIntervalDuration(\DateInterval $autoDeleteIntervalDuration): TypeInterface;

    public function getAutoDeleteIntervalDuration(): \DateInterval;

    public function setScheduleLimitAllowance(int $scheduleLimitAllowance): TypeInterface;

    public function getScheduleLimitAllowance(): int;

    public function getId(): int;

    public function setId(int $kojo_job_type_id): TypeInterface;
}