<?php

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Db\ModelInterface;

interface TypeInterface extends ModelInterface
{
    const TABLE_NAME                      = 'nhds_job_type';
    const FIELD_NAME_ID                   = 'nhds_job_type_id';
    const FIELD_NAME_TYPE_CODE            = 'type_code';
    const FIELD_NAME_NAME                 = 'name';
    const FIELD_NAME_WORKER_URI           = 'worker_uri';
    const FIELD_NAME_WORKER_METHOD        = 'worker_method';
    const FIELD_NAME_CAN_WORK_IN_PARALLEL = 'can_work_in_parallel';
    const FIELD_NAME_DEFAULT_IMPORTANCE   = 'default_importance';
    const FIELD_NAME_CRON_EXPRESSION      = 'cron_expression';
    const FIELD_NAME_SCHEDULE_LIMIT       = 'schedule_limit';
    const FIELD_NAME_IS_ENABLED           = 'is_enabled';
    const INDEX_NAME_SCHEDULER_COVERING   = 'SCHEDULER_COVERING';

    public function setCode(string $code): TypeInterface;

    public function getCode(): string;

    public function setName(string $name): TypeInterface;

    public function getName(): string;

    public function setWorkerClassUri(string $workerModelUri): TypeInterface;

    public function getWorkerUri(): string;

    public function setWorkerMethod(string $workerMethod): TypeInterface;

    public function getWorkerMethod(): string;

    public function setCanWorkInParallel(bool $canWorkInParallel): TypeInterface;

    public function getCanWorkInParallel(): bool;

    public function setDefaultImportance(int $defaultImportance): TypeInterface;

    public function getDefaultImportance(): int;

    public function setCronExpression(string $cronExpression): TypeInterface;

    public function getCronExpression(): string;

    public function setScheduleLimit(int $scheduleLimit): TypeInterface;

    public function getScheduleLimit(): int;

    public function setIsEnabled(bool $isEnabled): TypeInterface;

    public function getIsEnabled(): bool;
}