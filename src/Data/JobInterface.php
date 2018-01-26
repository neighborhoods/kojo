<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data;

use NHDS\Jobs\Db\ModelInterface;

interface JobInterface extends ModelInterface
{
    const TABLE_NAME                                       = 'nhds_job';
    const FIELD_NAME_ID                                    = 'nhds_job_id';
    const FIELD_NAME_TYPE_CODE                             = 'type_code';
    const FIELD_NAME_NAME                                  = 'name';
    const FIELD_NAME_PRIORITY                              = 'priority';
    const FIELD_NAME_IMPORTANCE                            = 'importance';
    const FIELD_NAME_STATUS_ID                             = 'status_id';
    const FIELD_NAME_WORK_AT_DATE_TIME                     = 'work_at_date_time';
    const FIELD_NAME_NEXT_STATE_REQUEST                    = 'next_state_request';
    const FIELD_NAME_ASSIGNED_STATE                        = 'assigned_state';
    const FIELD_NAME_PREVIOUS_STATE                        = 'previous_state';
    const FIELD_NAME_WORKER_URI                            = 'worker_uri';
    const FIELD_NAME_WORKER_METHOD                         = 'worker_method';
    const FIELD_NAME_CAN_WORK_IN_PARALLEL                  = 'can_work_in_parallel';
    const FIELD_NAME_LAST_TRANSITION_DATE_TIME             = 'last_transition_date_time';
    const FIELD_NAME_LAST_TRANSITION_MICRO_TIME            = 'last_transition_micro_time';
    const FIELD_NAME_TIMES_WORKED                          = 'times_worked';
    const FIELD_NAME_TIMES_RETRIED                         = 'times_retried';
    const FIELD_NAME_TIMES_HELD                            = 'times_held';
    const FIELD_NAME_TIMES_CRASHED                         = 'times_crashed';
    const FIELD_NAME_TIMES_PANICKED                        = 'times_panicked';
    const FIELD_NAME_CREATED_AT_DATE_TIME                  = 'created_at_date_time';
    const FIELD_NAME_COMPLETED_AT_DATE_TIME                = 'completed_at_date_time';
    const FIELD_NAME_DELETE_AFTER_DATE_TIME                = 'delete_after_date_time';
    const FOREIGN_KEY_NAME_JOB_TYPE_CODE                   = 'JOB_TYPE_CODE';
    const INDEX_NAME_SCHEDULER                             = 'SCHEDULER';
    const INDEX_NAME_PENDING                               = 'PENDING';
    const INDEX_NAME_CRASHED_AND_SELECTION_AND_LIMIT_CHECK = 'CRASHED_AND_SELECTION_AND_LIMIT_CHECK';
    const INDEX_NAME_AUTO_DELETE                           = 'DELETE_AFTER';
    const FIELD_NAME_PROCESS_TYPE_CODE                     = 'process_type_code';

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

    public function setCreatedAtDateTime(\DateTime $createdAtDateTime): JobInterface;

    public function getCreatedAtDateTime(): \DateTime;

    public function setCompletedAtDateTime(\DateTime $completedAtDateTime): JobInterface;

    public function getCompletedAtDateTime(): \DateTime;

    public function setDeleteAfterDateTime(\DateTime $deleteAfterDateTime): JobInterface;

    public function getDeleteAfterDateTime(): \DateTime;

    public function setProcessTypeCode(string $processTypeCode): JobInterface;

    public function getProcessTypeCode(): string;
}