<?php

namespace NHDS\Jobs;

use NHDS\Jobs\Data\Property\Crud;
use NHDS\Jobs\Data\JobInterface;

class Service implements ServiceInterface
{
    use Crud\AwareTrait;
    use NHDS\Jobs\AwareTrait;
    const PROP_TYPE_CODE         = 'type_code';
    const PROP_WORK_AT_DATE_TIME = 'work_at_date_time';
    const PROP_IMPORTANCE        = 'importance';
    const PROP_JOB_ID            = 'job_id';
    const PROP_JOB               = 'job';

    public function setTypeCode(string $typeCode): ServiceInterface
    {
        $this->_create(self::PROP_TYPE_CODE, $typeCode);

        return $this;
    }

    public function setWorkAtDateTime(\DateTime $workAtDateTime): ServiceInterface
    {
        $this->_create(self::PROP_WORK_AT_DATE_TIME, $workAtDateTime);

        return $this;
    }

    public function setImportance(int $importance): ServiceInterface
    {
        $this->_create(self::PROP_IMPORTANCE, $importance);

        return $this;
    }

    public function getJobId(): int
    {
        return $this->_read(self::PROP_JOB_ID);
    }

    public function getJobTypeCode(): string
    {
        return $this->_read(self::PROP_TYPE_CODE);
    }

    public function setJob(JobInterface $job): ServiceInterface
    {
        $this->_create(self::PROP_JOB, $job);
    }

    public function save(): ServiceInterface
    {
        return $this;
    }
}