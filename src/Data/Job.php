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
    }

    public function getTypeCode(): string
    {
        // TODO: Implement getTypeCode() method.
    }

    public function setName(string $name): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_NAME, $name);
    }

    public function getName(): string
    {
        // TODO: Implement getName() method.
    }

    public function setPriority(int $priority): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_PRIORITY, $priority);
    }

    public function getPriority(): int
    {
        // TODO: Implement getPriority() method.
    }

    public function setImportance(int $importance): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_IMPORTANCE, $importance);
    }

    public function getImportance(): int
    {
        // TODO: Implement getImportance() method.
    }

    public function setStatusId(int $statusId): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_STATUS_ID, $statusId);
    }

    public function getStatusId(): int
    {
        // TODO: Implement getStatusId() method.
    }

    public function setWorkAtDateTime(\DateTime $workAtDateTime): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_WORK_AT_DATETIME, $workAtDateTime);
    }

    public function getWorkAtDateTime(): \DateTime
    {
        // TODO: Implement getWorkAtDateTime() method.
    }

    public function setPreviousState(string $previousState): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_PREVIOUS_STATE, $previousState);
    }

    public function getPreviousState(): string
    {
        // TODO: Implement getPreviousState() method.
    }

    public function setWorkerUri(string $workerUri): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_WORKER_URI, $workerUri);
    }

    public function getWorkerUri(): string
    {
        // TODO: Implement getWorkerUri() method.
    }

    public function setWorkerMethod(string $workerMethod): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_WORKER_METHOD, $workerMethod);
    }

    public function getWorkerMethod(): string
    {
        // TODO: Implement getWorkerMethod() method.
    }

    public function setCanRunInParallel(bool $canRunInParallel): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_CAN_RUN_IN_PARALLEL, $canRunInParallel);
    }

    public function getCanRunInParallel(): bool
    {
        // TODO: Implement getCanRunInParallel() method.
    }

    public function getLastTransitionInDateTime(): \DateTime
    {
        // TODO: Implement getLastTransitionInDateTime() method.
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

    public function getLastTransitionInMicroTime(): \DateTime
    {
        // TODO: Implement getLastTransitionInMicroTime() method.
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

    public function setTimesWorked(int $timesWorked): JobInterface
    {
        // TODO: Implement setTimesWorked() method.
    }

    public function getTimesWorked(): int
    {
        // TODO: Implement getTimesWorked() method.
    }

    public function setTimesRetried(int $timesRetried): JobInterface
    {
        // TODO: Implement setTimesRetried() method.
    }

    public function getTimesRetried(): int
    {
        // TODO: Implement getTimesRetried() method.
    }

    public function setTimesHeld(int $timesHeld): JobInterface
    {
        // TODO: Implement setTimesHeld() method.
    }

    public function getTimesHeld(): int
    {
        // TODO: Implement getTimesHeld() method.
    }

    public function setTimesCrashed(int $timesCrashed): JobInterface
    {
        // TODO: Implement setTimesCrashed() method.
    }

    public function getTimesCrashed(): int
    {
        // TODO: Implement getTimesCrashed() method.
    }

    public function setTimesPanicked(int $timesPanicked): JobInterface
    {
        // TODO: Implement setTimesPanicked() method.
    }

    public function getTimesPanicked(): int
    {
        // TODO: Implement getTimesPanicked() method.
    }
}