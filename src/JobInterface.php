<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

interface JobInterface extends \JsonSerializable
{
    public const TABLE_NAME = 'kojo_job';
    public const FIELD_NAME_ID = 'kojo_job_id';
    public const FIELD_NAME_TYPE_CODE = 'type_code';
    public const FIELD_NAME_NAME = 'name';
    public const FIELD_NAME_PRIORITY = 'priority';
    public const FIELD_NAME_IMPORTANCE = 'importance';
    public const FIELD_NAME_WORK_AT_DATE_TIME = 'work_at_date_time';
    public const FIELD_NAME_NEXT_STATE_REQUEST = 'next_state_request';
    public const FIELD_NAME_ASSIGNED_STATE = 'assigned_state';
    public const FIELD_NAME_PREVIOUS_STATE = 'previous_state';
    public const FIELD_NAME_WORKER_URI = 'worker_uri';
    public const FIELD_NAME_WORKER_METHOD = 'worker_method';
    public const FIELD_NAME_CAN_WORK_IN_PARALLEL = 'can_work_in_parallel';
    public const FIELD_NAME_LAST_TRANSITION_DATE_TIME = 'last_transition_date_time';
    public const FIELD_NAME_LAST_TRANSITION_MICRO_TIME = 'last_transition_micro_time';
    public const FIELD_NAME_TIMES_WORKED = 'times_worked';
    public const FIELD_NAME_TIMES_RETRIED = 'times_retried';
    public const FIELD_NAME_TIMES_HELD = 'times_held';
    public const FIELD_NAME_TIMES_CRASHED = 'times_crashed';
    public const FIELD_NAME_TIMES_PANICKED = 'times_panicked';
    public const FIELD_NAME_CREATED_AT_DATE_TIME = 'created_at_date_time';
    public const FIELD_NAME_COMPLETED_AT_DATE_TIME = 'completed_at_date_time';
    public const FIELD_NAME_DELETE_AFTER_DATE_TIME = 'delete_after_date_time';
    public const FIELD_NAME_MOST_RECENT_HOST_NAME = 'most_recent_host_name';
    public const FIELD_NAME_MOST_RECENT_PROCESS_ID = 'most_recent_process_id';
    public const FOREIGN_KEY_NAME_JOB_TYPE_CODE = 'JOB_TYPE_CODE';
    public const INDEX_NAME_SCHEDULER = 'SCHEDULER';
    public const INDEX_NAME_PENDING = 'PENDING';
    public const INDEX_NAME_CRASHED_AND_SELECTION_AND_LIMIT_CHECK = 'CRASHED_AND_SELECTION_AND_LIMIT_CHECK';
    public const INDEX_NAME_AUTO_DELETE = 'DELETE_AFTER';

    public function getId(): int;

    public function setId(int $kojo_job_id): JobInterface;

    public function setTypeCode(string $typeCode): JobInterface;

    public function getTypeCode(): string;

    public function setName(string $name): JobInterface;

    public function getName(): string;

    public function setPriority(int $priority): JobInterface;

    public function getPriority(): int;

    public function setImportance(int $importance): JobInterface;

    public function getImportance(): int;

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

    public function setLastTransitionDateTime(\DateTime $dateTime): JobInterface;

    public function getLastTransitionDateTime(): \DateTime;

    public function setLastTransitionMicroTime(\DateTime $dateTime): JobInterface;

    public function getLastTransitionMicroTime(): \DateTime;

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

    public function setMostRecentHostName(string $mostRecentHostName): JobInterface;

    public function getMostRecentHostName(): string;

    public function setMostRecentProcessId(int $mostRecentProcessId): JobInterface;

    public function getMostRecentProcessId(): int;
}