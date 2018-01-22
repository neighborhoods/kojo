<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service;

use NHDS\Jobs\ServiceAbstract;
use NHDS\Jobs\State;
use NHDS\Jobs\Type;
use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Time;

class Create extends ServiceAbstract implements CreateInterface
{
    use Type\Repository\AwareTrait;
    use Job\Collection\ScheduleLimit\AwareTrait;
    use Time\AwareTrait;
    const PROP_IMPORTANCE        = 'importance';
    const PROP_WORK_AT_DATE_TIME = 'work_at_date_time';
    const PROP_JOB_TYPE_CODE     = 'job_type_code';
    const PROP_JOB_PREPARED      = 'job_prepared';

    public function setImportance(int $importance): CreateInterface
    {
        $this->_create(self::PROP_IMPORTANCE, $importance);

        return $this;
    }

    public function setWorkAtDateTime(\DateTime $workAtDateTime): CreateInterface
    {
        $this->_create(self::PROP_WORK_AT_DATE_TIME, $workAtDateTime);

        return $this;
    }

    protected function _prepareSave(): Create
    {
        $this->_prepareJob();
        if ($this->_getJobType()->getScheduleLimit() > 0) {
            $this->_getStateService()->requestScheduleLimitCheck();
        }else {
            $this->_getStateService()->requestWaitForWork();
        }

        return $this;
    }

    protected function _save(): Create
    {
        $this->_prepareSave();
        $this->_getStateService()->setJob($this->_getJob());
        $this->_getStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }

    protected function _prepareJob(): Create
    {
        if (!$this->_exists(self::PROP_JOB_PREPARED)) {
            $jobType = $this->_getJobType();
            if ($jobType->getIsEnabled()) {
                $persistentJobTypeProperties = $jobType->readPersistentProperties();
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_ID]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_CRON_EXPRESSION]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_SCHEDULE_LIMIT]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_IS_ENABLED]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_AUTO_COMPLETE_SUCCESS]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_AUTO_DELETE_INTERVAL_DURATION]);
                if ($this->_exists(self::PROP_IMPORTANCE)) {
                    $importance = $this->_read(self::PROP_IMPORTANCE);
                }else {
                    $importance = (int) $persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_DEFAULT_IMPORTANCE];
                }
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_DEFAULT_IMPORTANCE]);
            }else {
                throw new \RuntimeException('Job type with type code ' . $jobType->getCode() . 'is not enabled.');
            }

            $job = $this->_getJob();
            $job->createPersistentProperties($persistentJobTypeProperties);
            $job->setImportance($importance);
            $job->setPriority($importance);
            $job->setWorkAtDateTime($this->_read(self::PROP_WORK_AT_DATE_TIME));
            $job->setCreatedAtDateTime($this->_getTime()->getNow());
            $job->setTimesWorked(0);
            $job->setNextStateRequest(State\Service::STATE_NONE);
            $job->setAssignedState(State\Service::STATE_NEW);
            $this->_create(self::PROP_JOB_PREPARED, true);
        }

        return $this;
    }

    protected function _getJobType(): Job\TypeInterface
    {
        if (!$this->_exists(Job\TypeInterface::class)) {
            $jobType = $this->_getTypeRepository()->getJobTypeClone($this->_getJobTypeCode());
            $this->_create(Job\TypeInterface::class, $jobType);
        }

        return $this->_read(Job\TypeInterface::class);
    }

    public function getJobId(): int
    {
        return $this->_getJob()->getId();
    }

    public function setJobTypeCode(string $jobTypeCode): CreateInterface
    {
        $this->_create(self::PROP_JOB_TYPE_CODE, $jobTypeCode);

        return $this;
    }

    protected function _getJobTypeCode(): string
    {
        return $this->_read(self::PROP_JOB_TYPE_CODE);
    }
}