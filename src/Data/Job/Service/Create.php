<?php

namespace NHDS\Jobs\Data\Job\Service;

use NHDS\Jobs\Data\Job;
use NHDS\Jobs\Data\Job\AbstractService;
use NHDS\Jobs\Data\Job\State;

class Create extends AbstractService implements CreateInterface
{
    use Job\Collection\ScheduleLimit\AwareTrait;
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

    public function save(): CreateInterface
    {
        $this->_prepareJob();
        if ($this->_getJobType()->getScheduleLimit() > 0) {
            $numberOfScheduledJobs = $this->_getJobCollectionScheduleLimit()->getNumberOfCurrentlyScheduledJobs();
            if ($numberOfScheduledJobs < $this->_getJobType()->getScheduleLimit()) {
                $this->_getJobStateService()->requestScheduleLimitCheck();
                $this->_save();
            }
        }else {
            $this->_getJobStateService()->requestWaitForWork();
            $this->_save();
        }

        return $this;
    }

    protected function _save(): Create
    {
        $this->_getJobStateService()->setJob($this->_getJob());
        $this->_getJobStateService()->applyRequest();
        $this->_getJob()->save();
        $this->_create(self::PROP_SAVED, true);

        return $this;
    }

    protected function _prepareJob(): Create
    {
        if (!$this->_exists(self::PROP_JOB_PREPARED)) {
            $jobType = $this->_getJobType();
            $jobType->load(Job\TypeInterface::FIELD_NAME_TYPE_CODE, $this->_getJobTypeCode());
            if ($jobType->getIsEnabled()) {
                $persistentJobTypeProperties = $jobType->getPersistentProperties();
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_ID]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_CRON_EXPRESSION]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_SCHEDULE_LIMIT]);
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_IS_ENABLED]);
                if ($this->_exists(self::PROP_IMPORTANCE)) {
                    $importance = $this->_read(self::PROP_IMPORTANCE);
                }else {
                    $importance = $persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_DEFAULT_IMPORTANCE];
                }
                unset($persistentJobTypeProperties[Job\TypeInterface::FIELD_NAME_DEFAULT_IMPORTANCE]);
            }else {
                throw new \RuntimeException('Job type with type code ' . $jobType->getCode() . 'is not enabled.');
            }

            $job = $this->_getJob();
            $job->setPersistentProperties($persistentJobTypeProperties);
            $job->setImportance($importance);
            $job->setWorkAtDateTime($this->_read(self::PROP_WORK_AT_DATE_TIME));
            $job->setTimesWorked(0);
            $job->setNextStateRequest(State\Service::STATE_NONE);
            $job->setAssignedState(State\Service::STATE_NEW);
            $this->_create(self::PROP_JOB_PREPARED, true);
        }

        return $this;
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