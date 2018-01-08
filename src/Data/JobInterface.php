<?php

namespace NHDS\Jobs\Data;

use NHDS\Jobs\Db\ModelInterface;

interface JobInterface extends ModelInterface
{
    const TABLE_NAME                            = 'nhds_job';
    const FIELD_NAME_ID                         = 'nhds_job_id';
    const FIELD_NAME_TYPE_CODE                  = 'type_code';
    const FIELD_NAME_NAME                       = 'name';
    const FIELD_NAME_PRIORITY                   = 'priority';
    const FIELD_NAME_IMPORTANCE                 = 'importance';
    const FIELD_NAME_STATUS_ID                  = 'status_id';
    const FIELD_NAME_WORK_AT_DATETIME           = 'work_at_datetime';
    const FIELD_NAME_NEXT_STATE_REQUEST         = 'next_state_request';
    const FIELD_NAME_ASSIGNED_STATE             = 'assigned_state';
    const FIELD_NAME_PREVIOUS_STATE             = 'previous_state';
    const FIELD_NAME_WORKER_URI                 = 'worker_uri';
    const FIELD_NAME_WORKER_METHOD              = 'worker_method';
    const FIELD_NAME_CAN_WORK_IN_PARALLEL       = 'can_work_in_parallel';
    const FIELD_NAME_LAST_TRANSITION_DATETIME   = 'last_transition_datetime';
    const FIELD_NAME_LAST_TRANSITION_MICRO_TIME = 'last_transition_micro_time';
    const FIELD_NAME_TIMES_WORKED               = 'times_worked';
    const FIELD_NAME_TIMES_RETRIED              = 'times_retried';
    const FIELD_NAME_TIMES_HELD                 = 'times_held';
    const FIELD_NAME_TIMES_CRASHED              = 'times_crashed';
    const FIELD_NAME_TIMES_PANICKED             = 'times_panicked';
    const FOREIGN_KEY_NAME_JOB_TYPE_CODE        = 'JOB_TYPE_CODE';
    const INDEX_NAME_SCHEDULER                  = 'SCHEDULER';
    const INDEX_NAME_PENDING                    = 'PENDING';
    const INDEX_NAME_CRASHED_AND_SELECTION      = 'CRASHED_AND_SELECTION';

    public function setTypeCode(string $typeCode): JobInterface;

    public function getTypeCode(): string;

    public function setName(string $name): JobInterface;

    public function getName(): string;

    public function setPriority(int $priority): JobInterface;

    public function getPriority(): int;

    public function setImportance(int $importance): JobInterface;

    public function getImportance(): int;

    public function setStatusId(int $statusId): JobInterface;

    public function getStatusId(): int;

    public function setWorkAtDateTime(\DateTime $workAtDateTime): JobInterface;

    public function getWorkAtDateTime(): \DateTime;

    public function setNextStateRequest(string $nextStateRequest): JobInterface;

    public function getNextStateRequest(): string;

    public function setAssignedState(string $assignedState): JobInterface;

    public function getAssignedState(): string;

    public function setPreviousState(string $previousState): JobInterface;

    public function getPreviousState(): string;

    public function setWorkerUri(string $workerUri): JobInterface;

    public function getWorkerUri(): string;

    public function setWorkerMethod(string $workerMethod): JobInterface;

    public function getWorkerMethod(): string;

    public function setCanWorkInParallel(bool $canRunInParallel): JobInterface;

    public function getCanWorkInParallel(): bool;

    public function setLastTransitionInDateTime(\DateTime $dateTime): JobInterface;

    public function getLastTransitionInDateTime(): \DateTime;

    public function setLastTransitionInMicroTime(\DateTime $dateTime): JobInterface;

    public function getLastTransitionInMicroTime(): \DateTime;

    public function setTimesWorked(int $timesWorked): JobInterface;

    public function getTimesWorked(): int;

    public function setTimesRetried(int $timesRetried): JobInterface;

    public function getTimesRetried(): int;

    public function setTimesHeld(int $timesHeld): JobInterface;

    public function getTimesHeld(): int;

    public function setTimesCrashed(int $timesCrashed): JobInterface;

    public function getTimesCrashed(): int;

    public function setTimesPanicked(int $timesPanicked): JobInterface;

    public function getTimesPanicked(): int;
}