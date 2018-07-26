<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

class Job implements JobInterface
{
    /** @var int */
    protected $kojo_job_id;
    /** @var string */
    protected $type_code;
    /** @var string */
    protected $name;
    /** @var int */
    protected $priority;
    /** @var int */
    protected $importance;
    /** @var \DateTime */
    protected $work_at_date_time;
    /** @var string */
    protected $next_state_request;
    /** @var string */
    protected $assigned_state;
    /** @var string */
    protected $previous_state;
    /** @var string */
    protected $worker_uri;
    /** @var string */
    protected $worker_method;
    /** @var bool */
    protected $can_work_in_parallel;
    /** @var \DateTime */
    protected $last_transition_date_time;
    /** @var \DateTime */
    protected $last_transition_micro_time;
    /** @var int */
    protected $times_worked;
    /** @var int */
    protected $times_retried;
    /** @var int */
    protected $times_held;
    /** @var int */
    protected $times_crashed;
    /** @var int */
    protected $times_panicked;
    /** @var \DateTime */
    protected $created_at_date_time;
    /** @var \DateTime */
    protected $completed_at_date_time;
    /** @var \DateTime */
    protected $delete_after_date_time;
    /** @var string */
    protected $most_recent_host_name;
    /** @var int */
    protected $most_recent_process_id;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function getId(): int
    {
        if ($this->kojo_job_id === null) {
            throw new \LogicException('Job kojo_job_id has not been set.');
        }

        return $this->kojo_job_id;
    }

    public function setId(int $kojo_job_id): JobInterface
    {
        if ($this->kojo_job_id !== null) {
            throw new \LogicException('Job kojo_job_id is already set.');
        }
        $this->kojo_job_id = $kojo_job_id;

        return $this;
    }

    public function getTypeCode(): string
    {
        if ($this->type_code === null) {
            throw new \LogicException('Job type_code has not been set.');
        }

        return $this->type_code;
    }

    public function setTypeCode(string $type_code): JobInterface
    {
        if ($this->type_code !== null) {
            throw new \LogicException('Job type_code is already set.');
        }
        $this->type_code = $type_code;

        return $this;
    }

    public function getName(): string
    {
        if ($this->name === null) {
            throw new \LogicException('Job name has not been set.');
        }

        return $this->name;
    }

    public function setName(string $name): JobInterface
    {
        if ($this->name !== null) {
            throw new \LogicException('Job name is already set.');
        }
        $this->name = $name;

        return $this;
    }

    public function getPriority(): int
    {
        if ($this->priority === null) {
            throw new \LogicException('Job priority has not been set.');
        }

        return $this->priority;
    }

    public function setPriority(int $priority): JobInterface
    {
        if ($this->priority !== null) {
            throw new \LogicException('Job priority is already set.');
        }
        $this->priority = $priority;

        return $this;
    }

    public function getImportance(): int
    {
        if ($this->importance === null) {
            throw new \LogicException('Job importance has not been set.');
        }

        return $this->importance;
    }

    public function setImportance(int $importance): JobInterface
    {
        if ($this->importance !== null) {
            throw new \LogicException('Job importance is already set.');
        }
        $this->importance = $importance;

        return $this;
    }

    public function getWorkAtDateTime(): \DateTime
    {
        if ($this->work_at_date_time === null) {
            throw new \LogicException('Job work_at_date_time has not been set.');
        }

        return $this->work_at_date_time;
    }

    public function setWorkAtDateTime(\DateTime $work_at_date_time): JobInterface
    {
        if ($this->work_at_date_time !== null) {
            throw new \LogicException('Job work_at_date_time is already set.');
        }
        $this->work_at_date_time = $work_at_date_time;

        return $this;
    }

    public function getNextStateRequest(): string
    {
        if ($this->next_state_request === null) {
            throw new \LogicException('Job next_state_request has not been set.');
        }

        return $this->next_state_request;
    }

    public function setNextStateRequest(string $next_state_request): JobInterface
    {
        if ($this->next_state_request !== null) {
            throw new \LogicException('Job next_state_request is already set.');
        }
        $this->next_state_request = $next_state_request;

        return $this;
    }

    public function getAssignedState(): string
    {
        if ($this->assigned_state === null) {
            throw new \LogicException('Job assigned_state has not been set.');
        }

        return $this->assigned_state;
    }

    public function setAssignedState(string $assigned_state): JobInterface
    {
        if ($this->assigned_state !== null) {
            throw new \LogicException('Job assigned_state is already set.');
        }
        $this->assigned_state = $assigned_state;

        return $this;
    }

    public function getPreviousState(): string
    {
        if ($this->previous_state === null) {
            throw new \LogicException('Job previous_state has not been set.');
        }

        return $this->previous_state;
    }

    public function setPreviousState(string $previous_state): JobInterface
    {
        if ($this->previous_state !== null) {
            throw new \LogicException('Job previous_state is already set.');
        }
        $this->previous_state = $previous_state;

        return $this;
    }

    public function getWorkerUri(): string
    {
        if ($this->worker_uri === null) {
            throw new \LogicException('Job worker_uri has not been set.');
        }

        return $this->worker_uri;
    }

    public function setWorkerUri(string $worker_uri): JobInterface
    {
        if ($this->worker_uri !== null) {
            throw new \LogicException('Job worker_uri is already set.');
        }
        $this->worker_uri = $worker_uri;

        return $this;
    }

    public function getWorkerMethod(): string
    {
        if ($this->worker_method === null) {
            throw new \LogicException('Job worker_method has not been set.');
        }

        return $this->worker_method;
    }

    public function setWorkerMethod(string $worker_method): JobInterface
    {
        if ($this->worker_method !== null) {
            throw new \LogicException('Job worker_method is already set.');
        }
        $this->worker_method = $worker_method;

        return $this;
    }

    public function getCanWorkInParallel(): bool
    {
        if ($this->can_work_in_parallel === null) {
            throw new \LogicException('Job can_work_in_parallel has not been set.');
        }

        return $this->can_work_in_parallel;
    }

    public function setCanWorkInParallel(bool $can_work_in_parallel): JobInterface
    {
        if ($this->can_work_in_parallel !== null) {
            throw new \LogicException('Job can_work_in_parallel is already set.');
        }
        $this->can_work_in_parallel = $can_work_in_parallel;

        return $this;
    }

    public function getLastTransitionDateTime(): \DateTime
    {
        if ($this->last_transition_date_time === null) {
            throw new \LogicException('Job last_transition_date_time has not been set.');
        }

        return $this->last_transition_date_time;
    }

    public function setLastTransitionDateTime(\DateTime $last_transition_date_time): JobInterface
    {
        if ($this->last_transition_date_time !== null) {
            throw new \LogicException('Job last_transition_date_time is already set.');
        }
        $this->last_transition_date_time = $last_transition_date_time;

        return $this;
    }

    public function getLastTransitionMicroTime(): \DateTime
    {
        if ($this->last_transition_micro_time === null) {
            throw new \LogicException('Job last_transition_micro_time has not been set.');
        }

        return $this->last_transition_micro_time;
    }

    public function setLastTransitionMicroTime(\DateTime $last_transition_micro_time): JobInterface
    {
        if ($this->last_transition_micro_time !== null) {
            throw new \LogicException('Job last_transition_micro_time is already set.');
        }
        $this->last_transition_micro_time = $last_transition_micro_time;

        return $this;
    }

    public function getTimesWorked(): int
    {
        if ($this->times_worked === null) {
            throw new \LogicException('Job times_worked has not been set.');
        }

        return $this->times_worked;
    }

    public function setTimesWorked(int $times_worked): JobInterface
    {
        if ($this->times_worked !== null) {
            throw new \LogicException('Job times_worked is already set.');
        }
        $this->times_worked = $times_worked;

        return $this;
    }

    public function getTimesRetried(): int
    {
        if ($this->times_retried === null) {
            throw new \LogicException('Job times_retried has not been set.');
        }

        return $this->times_retried;
    }

    public function setTimesRetried(int $times_retried): JobInterface
    {
        if ($this->times_retried !== null) {
            throw new \LogicException('Job times_retried is already set.');
        }
        $this->times_retried = $times_retried;

        return $this;
    }

    public function getTimesHeld(): int
    {
        if ($this->times_held === null) {
            throw new \LogicException('Job times_held has not been set.');
        }

        return $this->times_held;
    }

    public function setTimesHeld(int $times_held): JobInterface
    {
        if ($this->times_held !== null) {
            throw new \LogicException('Job times_held is already set.');
        }
        $this->times_held = $times_held;

        return $this;
    }

    public function getTimesCrashed(): int
    {
        if ($this->times_crashed === null) {
            throw new \LogicException('Job times_crashed has not been set.');
        }

        return $this->times_crashed;
    }

    public function setTimesCrashed(int $times_crashed): JobInterface
    {
        if ($this->times_crashed !== null) {
            throw new \LogicException('Job times_crashed is already set.');
        }
        $this->times_crashed = $times_crashed;

        return $this;
    }

    public function getTimesPanicked(): int
    {
        if ($this->times_panicked === null) {
            throw new \LogicException('Job times_panicked has not been set.');
        }

        return $this->times_panicked;
    }

    public function setTimesPanicked(int $times_panicked): JobInterface
    {
        if ($this->times_panicked !== null) {
            throw new \LogicException('Job times_panicked is already set.');
        }
        $this->times_panicked = $times_panicked;

        return $this;
    }

    public function getCreatedAtDateTime(): \DateTime
    {
        if ($this->created_at_date_time === null) {
            throw new \LogicException('Job created_at_date_time has not been set.');
        }

        return $this->created_at_date_time;
    }

    public function setCreatedAtDateTime(\DateTime $created_at_date_time): JobInterface
    {
        if ($this->created_at_date_time !== null) {
            throw new \LogicException('Job created_at_date_time is already set.');
        }
        $this->created_at_date_time = $created_at_date_time;

        return $this;
    }

    public function getCompletedAtDateTime(): \DateTime
    {
        if ($this->completed_at_date_time === null) {
            throw new \LogicException('Job completed_at_date_time has not been set.');
        }

        return $this->completed_at_date_time;
    }

    public function setCompletedAtDateTime(\DateTime $completed_at_date_time): JobInterface
    {
        if ($this->completed_at_date_time !== null) {
            throw new \LogicException('Job completed_at_date_time is already set.');
        }
        $this->completed_at_date_time = $completed_at_date_time;

        return $this;
    }

    public function getDeleteAfterDateTime(): \DateTime
    {
        if ($this->delete_after_date_time === null) {
            throw new \LogicException('Job delete_after_date_time has not been set.');
        }

        return $this->delete_after_date_time;
    }

    public function setDeleteAfterDateTime(\DateTime $delete_after_date_time): JobInterface
    {
        if ($this->delete_after_date_time !== null) {
            throw new \LogicException('Job delete_after_date_time is already set.');
        }
        $this->delete_after_date_time = $delete_after_date_time;

        return $this;
    }

    public function getMostRecentHostName(): string
    {
        if ($this->most_recent_host_name === null) {
            throw new \LogicException('Job most_recent_host_name has not been set.');
        }

        return $this->most_recent_host_name;
    }

    public function setMostRecentHostName(string $most_recent_host_name): JobInterface
    {
        if ($this->most_recent_host_name !== null) {
            throw new \LogicException('Job most_recent_host_name is already set.');
        }
        $this->most_recent_host_name = $most_recent_host_name;

        return $this;
    }

    public function getMostRecentProcessId(): int
    {
        if ($this->most_recent_process_id === null) {
            throw new \LogicException('Job most_recent_process_id has not been set.');
        }

        return $this->most_recent_process_id;
    }

    public function setMostRecentProcessId(int $most_recent_process_id): JobInterface
    {
        if ($this->most_recent_process_id !== null) {
            throw new \LogicException('Job most_recent_process_id is already set.');
        }
        $this->most_recent_process_id = $most_recent_process_id;

        return $this;
    }

}