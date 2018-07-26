<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service;

use Neighborhoods\Kojo\ServiceInterface;
use Neighborhoods\Kojo\State;
use Neighborhoods\Kojo\Job;
use Neighborhoods\Kojo;
use Neighborhoods\Kojo\Time;

class Create implements CreateInterface
{
    use Kojo\Job\Collection\ScheduleLimit\AwareTrait;
    use Kojo\Job\AwareTrait;
    use State\Service\AwareTrait;
    use Job\Type\Repository\AwareTrait;
    use Job\Repository\AwareTrait;
    use Job\Collection\ScheduleLimit\AwareTrait;
    use Time\AwareTrait;
    protected $isPrepared = false;
    protected $importance;
    protected $workAtDateTime;
    protected $jobTypeCode;
    protected $jobType;

    protected function _prepareSave(): Create
    {
        $this->prepareJob();
        if ($this->getJobType()->getScheduleLimit() > 0) {
            $this->getStateService()->requestScheduleLimitCheck();
        } else {
            $this->getStateService()->requestWaitForWork();
        }

        return $this;
    }

    public function save(): ServiceInterface
    {
        $this->_prepareSave();
        $this->getStateService()->setJob($this->getJob());
        $this->getStateService()->applyRequest();
        $this->getJobRepository()->save($this->getJob());

        return $this;
    }

    protected function prepareJob(): Create
    {
        if (!$this->isPrepared) {
            $jobType = $this->getJobType();
            if ($jobType->getIsEnabled()) {
                $persistentJobTypeProperties = $jobType->readPersistentProperties();
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_ID]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_CRON_EXPRESSION]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_SCHEDULE_LIMIT]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_SCHEDULE_LIMIT_ALLOWANCE]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_IS_ENABLED]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_AUTO_COMPLETE_SUCCESS]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_AUTO_DELETE_INTERVAL_DURATION]);
                if ($this->getImportance()) {
                    $importance = $this->getImportance();
                } else {
                    $importance = (int)$persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_DEFAULT_IMPORTANCE];
                }
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_DEFAULT_IMPORTANCE]);
            } else {
                throw new \RuntimeException('Job type with type code[' . $jobType->getTypeCode() . '] is not enabled.');
            }

            $job = $this->getJob();
            $job->createPersistentProperties($persistentJobTypeProperties);
            $job->setImportance($importance);
            $job->setPriority($importance);
            $job->setWorkAtDateTime($this->getWorkAtDateTime());
            $job->setCreatedAtDateTime($this->getTime()->getNow());
            $job->setTimesWorked(0);
            $job->setTimesRetried(0);
            $job->setTimesCrashed(0);
            $job->setTimesHeld(0);
            $job->setTimesPanicked(0);
            $job->setNextStateRequest(State\Service::STATE_NONE);
            $job->setAssignedState(State\Service::STATE_NEW);
            $this->isPrepared = true;
        }

        return $this;
    }

    protected function getJobType(): Job\TypeInterface
    {
        if ($this->jobType === null) {
            $jobType = $this->getJobTypeRepository()->get($this->getJobTypeCode());
            $this->jobType = $jobType;
        }

        return $this->jobType;
    }

    public function getJobId(): int
    {
        return $this->getJob()->getId();
    }

    protected function getImportance(): int
    {
        if ($this->importance === null) {
            throw new \LogicException('Create importance has not been set.');
        }

        return $this->importance;
    }

    public function setImportance(int $importance): CreateInterface
    {
        if ($this->importance !== null) {
            throw new \LogicException('Create importance is already set.');
        }
        $this->importance = $importance;

        return $this;
    }

    protected function getWorkAtDateTime(): \DateTime
    {
        if ($this->workAtDateTime === null) {
            throw new \LogicException('Create workAtDateTime has not been set.');
        }

        return $this->workAtDateTime;
    }

    public function setWorkAtDateTime(\DateTime $workAtDateTime): CreateInterface
    {
        if ($this->workAtDateTime !== null) {
            throw new \LogicException('Create workAtDateTime is already set.');
        }
        $this->workAtDateTime = $workAtDateTime;

        return $this;
    }

    protected function getJobTypeCode(): string
    {
        if ($this->jobTypeCode === null) {
            throw new \LogicException('Create jobTypeCode has not been set.');
        }

        return $this->jobTypeCode;
    }

    public function setJobTypeCode(string $jobTypeCode): CreateInterface
    {
        if ($this->jobTypeCode !== null) {
            throw new \LogicException('Create jobTypeCode is already set.');
        }
        $this->jobTypeCode = $jobTypeCode;

        return $this;
    }
}