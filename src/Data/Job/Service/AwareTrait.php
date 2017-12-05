<?php

namespace NHDS\Jobs\Data\Job\Service;

use NHDS\Jobs\Data\Job;

trait AwareTrait
{
    public function setJobService(Job\ServiceInterface $jobService)
    {
        $this->_create(Job\ServiceInterface::class, $jobService);

        return $this;
    }

    protected function _getJobService(): Job\ServiceInterface
    {
        return $this->_read(Job\ServiceInterface::class);
    }

    protected function _getJobServiceClone(): Job\ServiceInterface
    {
        return clone $this->_getJobService();
    }
}