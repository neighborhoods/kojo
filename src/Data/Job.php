<?php

namespace NHDS\Jobs\Data;

use NHDS\Jobs\Db\Model;
use NHDS\Toolkit\TimeInterface;

class Job extends Model implements JobInterface
{
    public function __construct()
    {
        $this->setTableName(JobInterface::TABLE_NAME);
        $this->setIdPropertyName(JobInterface::FIELD_NAME_ID);

        return $this;
    }

    public function setAssignedState(string $assignedState): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_ASSIGNED_STATE, $assignedState);

        return $this;
    }

    public function getAssignedState(): string
    {
    }

    public function setNextStateRequest(string $nextStateRequest): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_NEXT_STATE_REQUEST, $nextStateRequest);

        return $this;
    }

    public function getNextStateRequest(): string
    {
    }

    public function setTypeCode(string $typeCode): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_TYPE_CODE, $typeCode);

        return $this;
    }

    public function getTypeCode(): string
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_TYPE_CODE);
    }

    public function setName(string $name): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_NAME, $name);

        return $this;
    }

    public function getName(): string
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_NAME);
    }

    public function setPriority(int $priority): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_PRIORITY, $priority);

        return $this;
    }

    public function getPriority(): int
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_PRIORITY);
    }

    public function setImportance(int $importance): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_IMPORTANCE, $importance);

        return $this;
    }

    public function getImportance(): int
    {
        // TODO: Implement getImportance() method.
    }

    public function setStatusId(int $statusId): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_STATUS_ID, $statusId);

        return $this;
    }

    public function getStatusId(): int
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_STATUS_ID);
    }

    public function setWorkAtDateTime(\DateTime $workAtDateTime): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_WORK_AT_DATETIME, $workAtDateTime);

        return $this;
    }

    public function getWorkAtDateTime(): \DateTime
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_WORK_AT_DATETIME);
    }

    public function setPreviousState(string $previousState): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_PREVIOUS_STATE, $previousState);

        return $this;
    }

    public function getPreviousState(): string
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_PREVIOUS_STATE);
    }

    public function setWorkerUri(string $workerUri): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_WORKER_URI, $workerUri);

        return $this;
    }

    public function getWorkerUri(): string
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_WORKER_URI);
    }

    public function setWorkerMethod(string $workerMethod): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_WORKER_METHOD, $workerMethod);

        return $this;
    }

    public function getWorkerMethod(): string
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_WORKER_METHOD);
    }

    public function setCanRunInParallel(bool $canRunInParallel): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_CAN_RUN_IN_PARALLEL, $canRunInParallel);

        return $this;
    }

    public function getCanRunInParallel(): bool
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_CAN_RUN_IN_PARALLEL);
    }

    public function setLastTransitionInDateTime(\DateTime $dateTime): JobInterface
    {
        $this->setLastTransitionInMicroTime($dateTime);
        $this->_setPersistentProperty(
            JobInterface::FIELD_NAME_LAST_TRANSITION_DATETIME,
            $dateTime->format(TimeInterface::MYSQL_DATETIME_FORMAT)
        );

        return $this;
    }

    public function getLastTransitionInDateTime(): \DateTime
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_LAST_TRANSITION_DATETIME);
    }

    public function setLastTransitionInMicroTime(\DateTime $dateTime): JobInterface
    {
        $this->setLastTransitionInDateTime($dateTime);
        $this->_setPersistentProperty(
            JobInterface::FIELD_NAME_LAST_TRANSITION_MICRO_TIME,
            $dateTime->format(TimeInterface::MICRO_TIME)
        );

        return $this;
    }

    public function getLastTransitionInMicroTime(): \DateTime
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_LAST_TRANSITION_MICRO_TIME);
    }

    public function setTimesWorked(int $timesWorked): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_TIMES_WORKED, $timesWorked);

        return $this;
    }

    public function getTimesWorked(): int
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_TIMES_WORKED);
    }

    public function setTimesRetried(int $timesRetried): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_TIMES_RETRIED, $timesRetried);

        return $this;
    }

    public function getTimesRetried(): int
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_TIMES_RETRIED);
    }

    public function setTimesHeld(int $timesHeld): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_TIMES_HELD, $timesHeld);

        return $this;
    }

    public function getTimesHeld(): int
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_TIMES_HELD);
    }

    public function setTimesCrashed(int $timesCrashed): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_TIMES_CRASHED, $timesCrashed);

        return $this;
    }

    public function getTimesCrashed(): int
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_TIMES_CRASHED);
    }

    public function setTimesPanicked(int $timesPanicked): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_TIMES_PANICKED, $timesPanicked);

        return $this;
    }

    public function getTimesPanicked(): int
    {
        return $this->_getPersistentProperty(JobInterface::FIELD_NAME_TIMES_PANICKED);
    }
}