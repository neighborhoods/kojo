<?php

namespace NHDS\Jobs\Data\Job\Service;

use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Jobs\Data\Job\State;

class Create implements CreateInterface
{
    use State\Service\AwareTrait;
    use Crud\AwareTrait;
    use Job\Type\AwareTrait;
    use Job\AwareTrait;
    const PROP_IMPORTANCE        = 'importance';
    const PROP_WORK_AT_DATE_TIME = 'work_at_date_time';
    const PROP_SAVED             = 'saved';
    const PROP_JOB_TYPE_CODE     = 'job_type_code';

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
        $this->_create(self::PROP_SAVED, true);
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
        $job->setNextStateRequest(State\Service::STATE_NONE);
        $job->setAssignedState(State\Service::STATE_NEW);
        $job->setTimesWorked(0);
        $this->_getJobStateService()->setJob($job);
        $this->_getJobStateService()->requestWork();
        $this->_getJobStateService()->applyRequest();
        $job->save();

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