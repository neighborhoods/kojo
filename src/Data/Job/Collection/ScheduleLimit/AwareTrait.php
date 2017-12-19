<?php

namespace NHDS\Jobs\Data\Job\Collection\ScheduleLimit;

use NHDS\Jobs\Data\Job\Collection\ScheduleLimitInterface;
use NHDS\Jobs\Data\Job\TypeInterface;

trait AwareTrait
{
    protected $_jobCollectionScheduleLimits = [];

    public function setJobCollectionScheduleLimit(ScheduleLimitInterface $jobCollectionScheduleLimit)
    {
        $this->_create(ScheduleLimitInterface::class, $jobCollectionScheduleLimit);

        return $this;
    }

    protected function _getJobCollectionScheduleLimitByJobType(TypeInterface $jobType): ScheduleLimitInterface
    {
        if (!isset($this->_jobCollectionScheduleLimits[$jobType->getCode()])) {
            $scheduleLimit = $this->_getJobCollectionScheduleLimitClone();
            $scheduleLimit->setJobType($jobType);
            $this->_jobCollectionScheduleLimits[$jobType->getCode()] = $scheduleLimit;
        }

        return $this->_jobCollectionScheduleLimits[$jobType->getCode()];
    }

    protected function _getJobCollectionScheduleLimit(): ScheduleLimitInterface
    {
        if (!$this->_exists(ScheduleLimitInterface::class . '_INITIALIZED')) {
            /** @var ScheduleLimitInterface $scheduleLimitJobCollection */
            $scheduleLimitJobCollection = $this->_read(ScheduleLimitInterface::class);
            $scheduleLimitJobCollection->setJobType($this->_getJobType());
            $this->_create(ScheduleLimitInterface::class . '_INITIALIZED', true);
        }

        return $this->_read(ScheduleLimitInterface::class);
    }

    protected function _getJobCollectionScheduleLimitClone(): ScheduleLimitInterface
    {
        return clone $this->_getJobCollectionScheduleLimit();
    }
}