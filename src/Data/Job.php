<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data;

use Neighborhoods\Kojo\Db\Model;
use Neighborhoods\Toolkit\TimeInterface;
use Neighborhoods\Toolkit\Time;

class Job extends Model implements JobInterface
{
    use Time\AwareTrait;

    public function __construct()
    {
        $this->setTableName(JobInterface::TABLE_NAME);
        $this->setIdPropertyName(JobInterface::FIELD_NAME_ID);

        return $this;
    }

    public function setAssignedState(string $assignedState): JobInterface
    {
        $this->_createOrUpdatePersistentProperty(JobInterface::FIELD_NAME_ASSIGNED_STATE, $assignedState);

        return $this;
    }

    public function getAssignedState(): string
    {
        return $this->_readPersistentProperty(JobInterface::FIELD_NAME_ASSIGNED_STATE);
    }

    public function setNextStateRequest(string $nextStateRequest): JobInterface
    {
        $this->_createOrUpdatePersistentProperty(JobInterface::FIELD_NAME_NEXT_STATE_REQUEST, $nextStateRequest);

        return $this;
    }

    public function getNextStateRequest(): string
    {
        return $this->_readPersistentProperty(JobInterface::FIELD_NAME_NEXT_STATE_REQUEST);
    }

    public function setTypeCode(string $typeCode): JobInterface
    {
        $this->_createPersistentProperty(JobInterface::FIELD_NAME_TYPE_CODE, $typeCode);

        return $this;
    }

    public function getTypeCode(): string
    {
        return $this->_readPersistentProperty(JobInterface::FIELD_NAME_TYPE_CODE);
    }

    public function setName(string $name): JobInterface
    {
        $this->_createPersistentProperty(JobInterface::FIELD_NAME_NAME, $name);

        return $this;
    }

    public function getName(): string
    {
        return $this->_readPersistentProperty(JobInterface::FIELD_NAME_NAME);
    }

    public function setPriority(int $priority): JobInterface
    {
        $this->_createOrUpdatePersistentProperty(JobInterface::FIELD_NAME_PRIORITY, $priority);

        return $this;
    }

    public function getPriority(): int
    {
        return (int)$this->_readPersistentProperty(JobInterface::FIELD_NAME_PRIORITY);
    }

    public function setImportance(int $importance): JobInterface
    {
        $this->_createPersistentProperty(JobInterface::FIELD_NAME_IMPORTANCE, $importance);

        return $this;
    }

    public function getImportance(): int
    {
        return (int)$this->_readPersistentProperty(JobInterface::FIELD_NAME_IMPORTANCE);
    }

    public function setStatusId(int $statusId): JobInterface
    {
        $this->_createPersistentProperty(JobInterface::FIELD_NAME_STATUS_ID, $statusId);

        return $this;
    }

    public function getStatusId(): int
    {
        return (int)$this->_readPersistentProperty(JobInterface::FIELD_NAME_STATUS_ID);
    }

    public function setWorkAtDateTime(\DateTime $workAtDateTime): JobInterface
    {
        $this->_createOrUpdatePersistentProperty(
            JobInterface::FIELD_NAME_WORK_AT_DATE_TIME,
            $workAtDateTime->format(TimeInterface::MYSQL_DATE_TIME_FORMAT)
        );

        return $this;
    }

    public function getWorkAtDateTime(): \DateTime
    {
        $workAtDateTimeString = $this->_readPersistentProperty(JobInterface::FIELD_NAME_WORK_AT_DATE_TIME);

        return new \DateTime($workAtDateTimeString);
    }

    public function setPreviousState(string $previousState): JobInterface
    {
        $this->_createOrUpdatePersistentProperty(JobInterface::FIELD_NAME_PREVIOUS_STATE, $previousState);

        return $this;
    }

    public function getPreviousState(): string
    {
        return $this->_readPersistentProperty(JobInterface::FIELD_NAME_PREVIOUS_STATE);
    }

    public function setWorkerUri(string $workerUri): JobInterface
    {
        $this->_createPersistentProperty(JobInterface::FIELD_NAME_WORKER_URI, $workerUri);

        return $this;
    }

    public function getWorkerUri(): string
    {
        return $this->_readPersistentProperty(JobInterface::FIELD_NAME_WORKER_URI);
    }

    public function setWorkerMethod(string $workerMethod): JobInterface
    {
        $this->_createPersistentProperty(JobInterface::FIELD_NAME_WORKER_METHOD, $workerMethod);

        return $this;
    }

    public function getWorkerMethod(): string
    {
        return $this->_readPersistentProperty(JobInterface::FIELD_NAME_WORKER_METHOD);
    }

    public function setCanWorkInParallel(bool $canRunInParallel): JobInterface
    {
        $this->_createPersistentProperty(JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL, $canRunInParallel);

        return $this;
    }

    public function getCanWorkInParallel(): bool
    {
        return (bool)$this->_readPersistentProperty(JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL);
    }

    public function setLastTransitionInDateTime(\DateTime $dateTime): JobInterface
    {
        $this->_createOrUpdatePersistentProperty(
            JobInterface::FIELD_NAME_LAST_TRANSITION_MICRO_TIME,
            $dateTime->format(TimeInterface::MICRO_TIME)
        );
        $this->_createOrUpdatePersistentProperty(
            JobInterface::FIELD_NAME_LAST_TRANSITION_DATE_TIME,
            $dateTime->format(TimeInterface::MYSQL_DATE_TIME_FORMAT)
        );

        return $this;
    }

    public function getLastTransitionInDateTime(): \DateTime
    {
        $lastTransitionInDateTimeString = $this->_readPersistentProperty(
            JobInterface::FIELD_NAME_LAST_TRANSITION_DATE_TIME
        );

        return new \DateTime($lastTransitionInDateTimeString);
    }

    public function setLastTransitionInMicroTime(\DateTime $dateTime): JobInterface
    {
        $this->_createOrUpdatePersistentProperty(
            JobInterface::FIELD_NAME_LAST_TRANSITION_DATE_TIME,
            $dateTime->format(TimeInterface::MYSQL_DATE_TIME_FORMAT)
        );
        $this->_createOrUpdatePersistentProperty(
            JobInterface::FIELD_NAME_LAST_TRANSITION_MICRO_TIME,
            $dateTime->format(TimeInterface::MICRO_TIME)
        );

        return $this;
    }

    public function getLastTransitionInMicroTime(): \DateTime
    {
        $lastTransitionInMicroTimeString = $this->_readPersistentProperty(
            JobInterface::FIELD_NAME_LAST_TRANSITION_MICRO_TIME
        );

        return new \DateTime($lastTransitionInMicroTimeString);
    }

    public function setTimesWorked(int $timesWorked): JobInterface
    {
        if ($timesWorked < 0) {
            throw new \InvalidArgumentException('Times worked is less than zero.');
        }
        $this->_createOrUpdatePersistentProperty(JobInterface::FIELD_NAME_TIMES_WORKED, $timesWorked);

        return $this;
    }

    public function getTimesWorked(): int
    {
        return (int)$this->_readPersistentProperty(JobInterface::FIELD_NAME_TIMES_WORKED);
    }

    public function setTimesRetried(int $timesRetried): JobInterface
    {
        if ($timesRetried < 0) {
            throw new \InvalidArgumentException('Times retried is less than zero.');
        }
        $this->_createOrUpdatePersistentProperty(JobInterface::FIELD_NAME_TIMES_RETRIED, $timesRetried);

        return $this;
    }

    public function getTimesRetried(): int
    {
        return (int)$this->_readPersistentProperty(JobInterface::FIELD_NAME_TIMES_RETRIED);
    }

    public function setTimesHeld(int $timesHeld): JobInterface
    {
        if ($timesHeld < 0) {
            throw new \InvalidArgumentException('Times held is less than zero.');
        }
        $this->_createOrUpdatePersistentProperty(JobInterface::FIELD_NAME_TIMES_HELD, $timesHeld);

        return $this;
    }

    public function getTimesHeld(): int
    {
        return (int)$this->_readPersistentProperty(JobInterface::FIELD_NAME_TIMES_HELD);
    }

    public function setTimesCrashed(int $timesCrashed): JobInterface
    {
        if ($timesCrashed < 0) {
            throw new \InvalidArgumentException('Times crashed is less than zero.');
        }
        $this->_createOrUpdatePersistentProperty(JobInterface::FIELD_NAME_TIMES_CRASHED, $timesCrashed);

        return $this;
    }

    public function getTimesCrashed(): int
    {
        return (int)$this->_readPersistentProperty(JobInterface::FIELD_NAME_TIMES_CRASHED);
    }

    public function setTimesPanicked(int $timesPanicked): JobInterface
    {
        if ($timesPanicked < 0) {
            throw new \InvalidArgumentException('Times panicked is less than zero.');
        }
        $this->_createOrUpdatePersistentProperty(JobInterface::FIELD_NAME_TIMES_PANICKED, $timesPanicked);

        return $this;
    }

    public function getTimesPanicked(): int
    {
        return (int)$this->_readPersistentProperty(JobInterface::FIELD_NAME_TIMES_PANICKED);
    }

    public function setCreatedAtDateTime(\DateTime $createdAtDateTime): JobInterface
    {
        $this->_createOrUpdatePersistentProperty(
            JobInterface::FIELD_NAME_CREATED_AT_DATE_TIME,
            $createdAtDateTime->format(TimeInterface::MYSQL_DATE_TIME_FORMAT)
        );

        return $this;
    }

    public function getCreatedAtDateTime(): \DateTime
    {
        $createdAtDateTimeString = $this->_readPersistentProperty(JobInterface::FIELD_NAME_CREATED_AT_DATE_TIME);

        return new \DateTime($createdAtDateTimeString);
    }

    public function setCompletedAtDateTime(\DateTime $completedAtDateTime): JobInterface
    {
        $this->_createOrUpdatePersistentProperty(
            JobInterface::FIELD_NAME_COMPLETED_AT_DATE_TIME,
            $completedAtDateTime->format(TimeInterface::MYSQL_DATE_TIME_FORMAT)
        );

        return $this;
    }

    public function getCompletedAtDateTime(): \DateTime
    {
        $completedAtDateTimeString = $this->_readPersistentProperty(JobInterface::FIELD_NAME_COMPLETED_AT_DATE_TIME);

        return new \DateTime($completedAtDateTimeString);
    }

    public function setDeleteAfterDateTime(\DateTime $deleteAfterDateTime): JobInterface
    {
        $this->_createOrUpdatePersistentProperty(
            JobInterface::FIELD_NAME_DELETE_AFTER_DATE_TIME,
            $deleteAfterDateTime->format(TimeInterface::MYSQL_DATE_TIME_FORMAT)
        );

        return $this;
    }

    public function getDeleteAfterDateTime(): \DateTime
    {
        $deleteAfterDateTimeString = $this->_readPersistentProperty(JobInterface::FIELD_NAME_DELETE_AFTER_DATE_TIME);

        return new \DateTime($deleteAfterDateTimeString);
    }

    public function setProcessTypeCode(string $processTypeCode): JobInterface
    {
        $this->_createPersistentProperty(self::FIELD_NAME_PROCESS_TYPE_CODE, $processTypeCode);

        return $this;
    }

    public function getProcessTypeCode(): string
    {
        return $this->_readPersistentProperty(self::FIELD_NAME_PROCESS_TYPE_CODE);
    }
}