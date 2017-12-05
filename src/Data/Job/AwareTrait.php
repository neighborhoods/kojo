<?php

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\JobInterface;

trait AwareTrait
{
    public function setJob(JobInterface $job)
    {
        $this->_create(JobInterface::class, $job);

        return $this;
    }

    protected function _getJob(): JobInterface
    {
        return $this->_read(JobInterface::class);
    }

    protected function _getJobClone(): JobInterface
    {
        return clone $this->_getJob();
    }
}