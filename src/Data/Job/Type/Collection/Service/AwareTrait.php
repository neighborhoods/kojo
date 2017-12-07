<?php

namespace NHDS\Jobs\Data\Job\Type\Collection\Service;

use NHDS\Jobs\Data\Job\Type;

trait AwareTrait
{
    public function setJobTypeCollectionService(Type\Collection\ServiceInterface $jobCollectionService)
    {
        $this->_create(Type\Collection\ServiceInterface::class, $jobCollectionService);

        return $this;
    }

    protected function _getJobTypeCollectionService(): Type\Collection\ServiceInterface
    {
        return $this->_read(Type\Collection\ServiceInterface::class);
    }

    protected function _getJobTypeCollectionServiceClone(): Type\Collection\ServiceInterface
    {
        return clone $this->_getJobTypeCollectionService();
    }
}