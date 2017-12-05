<?php

namespace NHDS\Jobs\Data\Job\Collection\Service;

use NHDS\Jobs\Data\Job;

trait AwareTrait
{
    public function setJobCollectionService(Job\Collection\ServiceInterface $jobCollectionService)
    {
        $this->_create(Job\Collection\ServiceInterface::class, $jobCollectionService);

        return $this;
    }

    protected function _getJobCollectionService(): Job\Collection\ServiceInterface
    {
        return $this->_read(Job\Collection\ServiceInterface::class);
    }

    protected function _getJobCollectionServiceClone(): Job\Collection\ServiceInterface
    {
        return clone $this->_getJobCollectionService();
    }
}