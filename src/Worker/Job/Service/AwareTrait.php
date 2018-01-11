<?php

namespace NHDS\Jobs\Worker\Job\Service;

use NHDS\Jobs\Worker\Job\ServiceInterface;

trait AwareTrait
{
    public function setWorkerJobService(ServiceInterface $workerJobService)
    {
        $this->_create(ServiceInterface::class, $workerJobService);

        return $this;
    }

    protected function _getWorkerJobService(): ServiceInterface
    {
        return $this->_read(ServiceInterface::class);
    }

    protected function _getWorkerJobServiceClone(): ServiceInterface
    {
        return clone $this->_getJob();
    }
}