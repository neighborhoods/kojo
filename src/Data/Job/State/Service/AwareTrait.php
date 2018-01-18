<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\State\Service;

use NHDS\Jobs\Data\Job\State\ServiceInterface;

trait AwareTrait
{
    public function setJobStateService(ServiceInterface $jobStateService)
    {
        $this->_create(ServiceInterface::class, $jobStateService);

        return $this;
    }

    protected function _getJobStateService(): ServiceInterface
    {
        return $this->_read(ServiceInterface::class);
    }

    protected function _getJobStateServiceClone(): ServiceInterface
    {
        return clone $this->_getJobStateService();
    }
}