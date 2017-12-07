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

    public function setNextStateRequest(string $nextStateRequest): JobInterface
    {
        $this->_setPersistentProperty(JobInterface::FIELD_NAME_NEXT_STATE_REQUEST, $nextStateRequest);

        return $this;
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

    public function setLastTransitionInMicroTime(\DateTime $dateTime): JobInterface
    {
        $this->setLastTransitionInDateTime($dateTime);
        $this->_setPersistentProperty(
            JobInterface::FIELD_NAME_LAST_TRANSITION_MICRO_TIME,
            $dateTime->format(TimeInterface::MICRO_TIME)
        );

        return $this;
    }

    public function getAssignedState(): string
    {
    }

    public function getNextStateRequest(): string
    {
    }

    public function setTypeCode(string $typeCode): JobInterface
    {
        return $this;
    }

    public function setName(string $name): JobInterface
    {
        return $this;
    }

    public function setWorkAtDateTime(\DateTime $workAtDateTime): JobInterface
    {
        return $this;
    }

    public function setTimesCrashed(int $timesCrashed): JobInterface
    {
        return $this;
    }

    public function getTimesCrashed(): int
    {
    }

    public function getTimesPanicked(): int
    {
    }

    public function setTimesPanicked(int $timesPanicked): JobInterface
    {
        return $this;
    }

    public function getStatusId(): int
    {
    }

    public function setStatusId(int $statusId): JobInterface
    {
        return $this;
    }

    public function getTypeCode(): string
    {
    }

    public function setTimesWorked(int $timesWorked): JobInterface
    {
        return $this;
    }

    public function getTimesWorked(): int
    {
    }

    public function getTimesRetried(): int
    {
    }

    public function getName(): string
    {
        // TODO: Implement getName() method.
    }

    public function setPriority(int $priority): JobInterface
    {
        // TODO: Implement setPriority() method.
    }

    public function getPriority(): int
    {
        // TODO: Implement getPriority() method.
    }

    public function setImportance(int $importance): JobInterface
    {
        // TODO: Implement setImportance() method.
    }

    public function getImportance(): int
    {
        // TODO: Implement getImportance() method.
    }

    public function getWorkAtDateTime(): \DateTime
    {
        // TODO: Implement getWorkAtDateTime() method.
    }

    public function setWorkerUri(string $workerUri): JobInterface
    {
        // TODO: Implement setWorkerUri() method.
    }

    public function getWorkerUri(): string
    {
        // TODO: Implement getWorkerUri() method.
    }

    public function setWorkerMethod(string $workerUri): JobInterface
    {
        // TODO: Implement setWorkerMethod() method.
    }

    public function getWorkerMethod(): string
    {
        // TODO: Implement getWorkerMethod() method.
    }

    public function setCanRunInParallel(bool $canRunInParallel): JobInterface
    {
        // TODO: Implement setCanRunInParallel() method.
    }

    public function getCanRunInParallel(): bool
    {
        // TODO: Implement getCanRunInParallel() method.
    }

    public function getLastTransitionInDateTime(): \DateTime
    {
        // TODO: Implement getLastTransitionInDateTime() method.
    }

    public function getLastTransitionInMicroTime(): \DateTime
    {
        // TODO: Implement getLastTransitionInMicroTime() method.
    }

    public function setTimesRetried(int $timesRetried): JobInterface
    {
        // TODO: Implement setTimesRetried() method.
    }

    public function setTimesHeld(int $timesHeld): JobInterface
    {
        // TODO: Implement setTimesHeld() method.
    }

    public function getTimesHeld(): int
    {
        // TODO: Implement getTimesHeld() method.
    }

    public function setPreviousState(string $previousState): JobInterface
    {
        // TODO: Implement setPreviousState() method.
    }

    public function getPreviousState(): string
    {
        // TODO: Implement getPreviousState() method.
    }
}