<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job;

use Neighborhoods\Kojo\Data;
use Neighborhoods\Kojo\Data\JobInterface;

class FromArrayBuilder implements FromArrayBuilderInterface
{
    /** @var array */
    protected $record;

    public function build() : JobInterface
    {
        $job = new Data\Job();
        $record = $this->getRecord();

        $job->setId($record['kojo_job_id']);
        $job->setAssignedState($record['assigned_state']);
        $job->setNextStateRequest($record['next_state_request']);
        $job->setTypeCode($record['type_code']);
        $job->setName($record['name']);
        $job->setPriority($record['priority']);
        $job->setImportance($record['importance']);
        $job->setWorkAtDateTime(new \DateTime($record['work_at_date_time']));
        $job->setPreviousState($record['previous_state']);
        $job->setWorkerUri($record['worker_uri']);
        $job->setWorkerMethod($record['worker_method']);
        $job->setCanWorkInParallel($record['can_work_in_parallel']);
        $job->setLastTransitionInDateTime(new \DateTime($record['last_transition_date_time']));
        $job->setLastTransitionInMicroTime(
            \DateTime::createFromFormat(
                'U.u',
                sprintf(
                    '%s.%s',
                    (int)($record['last_transition_micro_time'] / 1000000),
                    $record['last_transition_micro_time'] % 1000000
                )
            )
        );
        $job->setTimesWorked($record['times_worked']);
        $job->setTimesRetried($record['times_retried']);
        $job->setTimesHeld($record['times_held']);
        $job->setTimesCrashed($record['times_crashed']);
        $job->setTimesPanicked($record['times_panicked']);
        $job->setCreatedAtDateTime(new \DateTime($record['created_at_date_time']));

        if (isset($record['completed_at_date_time'])) {
            $job->setCompletedAtDateTime(new \DateTime($record['completed_at_date_time']));
        }
        if (isset($record['delete_after_date_time'])) {
            $job->setDeleteAfterDateTime(new \DateTime($record['delete_after_date_time']));
        }

        return $job;
    }

    protected function getRecord() : array
    {
        if ($this->record === null) {
            throw new \LogicException('FromArrayBuilder record has not been set.');
        }

        return $this->record;
    }

    public function setRecord(array $record) : FromArrayBuilderInterface
    {
        if ($this->record !== null) {
            throw new \LogicException('FromArrayBuilder record is already set.');
        }

        $this->record = $record;

        return $this;
    }
}
