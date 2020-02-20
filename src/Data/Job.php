<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data;

use Neighborhoods\Kojo\Db;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;
use Neighborhoods\Kojo\JobStateChangeInterface;
use Neighborhoods\Pylon\TimeInterface;
use Neighborhoods\Kojo\JobStateChange;
use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

class Job extends Db\Model implements JobInterface, \JsonSerializable
{
    use JobStateChange\Factory\AwareTrait;
    use JobStateChange\Data\Factory\AwareTrait;
    use JobStateChange\Repository\AwareTrait;
    use Metadata\Builder\AwareTrait;

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

    public function save(): Db\ModelInterface
    {
        if (
            // if state didn't change, we don't have to override any behavior
            !array_key_exists(JobInterface::FIELD_NAME_ASSIGNED_STATE, $this->_readChangedPersistentProperties()) ||
            // because of how State\Service works, often assigned state will show up as changed, when really it hasn't
            $this->getAssignedState() === $this->getPreviousState()
        ) {
            return parent::save();
        }

        // Db\Models have to use a workaround to get RDBMS bigints to work with doctrine
        // this code extends that workaround to apply to the job we're about to serialize
        if ($this->hasId()) {
            $this->_createOrUpdatePersistentProperty($this->getIdPropertyName(), $this->getId());
        }

        // do this outside the transaction to marginally reduce the chance of failure
        $jobStateChange = $this->createJobStateChange();

        $connection = $this->_getDoctrineConnectionDecoratorRepository()->getConnection(DecoratorInterface::ID_JOB);
        /** @var \PDO $pdo */
        $pdo = $connection->getWrappedConnection();

        $isKojospaceTransaction = false;

        if ($pdo->inTransaction()) {
            // if we're already in a transaction (i.e. one started by userspace), we can proceed, knowing that
            // if userspace rolls back the transaction, it'll roll back the job state change as well
        } else {
            // otherwise, start a transaction in kojospace to make sure the JobStateChangelogProcessor doesn't see
            // the JobStateChange unless the actual job transitions successfully
            $pdo->beginTransaction();
            $isKojospaceTransaction = true;
        }

        try {
            parent::save();
            $this->getJobStateChangeRepository()->insertUsingConnection($jobStateChange, $connection);

            if ($isKojospaceTransaction) {
                $pdo->commit();
            }
        } catch (\Throwable $throwable) {
            // There are four cases here:
            // 1: this was caused by a failed database operation, and
            //      1A: we're in a kojospace transaction, or
            //      1B: we're in a userspace transaction
            // 2: this was not a failed database operation, and
            //      2A: the database operation succeeded before the failure, or
            //      2B: the database operation has not yet run
            // For 1A, we should roll back our internal transaction and bubble the throwable up to userspace
            // For 1B, whether or not we roll back the transaction doesn't matter, as long as we then bubble up the throwable
            // For 2A, I'm not totally sure how this could have happened, insert and/or transaction commits are the last
            //      things in this block, so ideally we'd have a way of letting userspace know "database stuff succeeded, so
            //      you don't need to roll back your transaction, but something else went wrong", but I think it's sufficiently
            //      edge-y to leave alone
            // For 2B, just re-throwing seems most appropriate
            if ($isKojospaceTransaction) {
                $pdo->rollBack();
            }

            throw $throwable;
        }

        return $this;
    }

    protected function createJobStateChange() : JobStateChangeInterface
    {
        $metadata = $this
            ->getProcessPoolLoggerMessageMetadataBuilder()
            ->setJob($this)
            ->build();

        $jobStateChangeData = $this->getJobStateChangeDataFactory()->create();
        $jobStateChangeData
            ->setOldState($this->getPreviousState())
            ->setNewState($this->getAssignedState())
            ->setTimestamp(new \DateTime())
            ->setMetadata($metadata);

        $jobStateChange = $this->getJobStateChangeFactory()->create();
        $jobStateChange->setData($jobStateChangeData);

        return $jobStateChange;
    }

    public function jsonSerialize()
    {
        return $this->_persistentProperties;
    }
}
