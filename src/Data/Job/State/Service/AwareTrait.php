<?php

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
        if (!$this->_exists(ServiceInterface::class . '_INITIALIZED')) {
            /** @var ServiceInterface $stateService */
            $stateService = $this->_read(ServiceInterface::class);
            $stateService->setJob($this->_getJob());
            $this->_create(ServiceInterface::class . '_INITIALIZED', true);
        }

        return $this->_read(ServiceInterface::class);
    }

    protected function _getJobStateServiceClone(): ServiceInterface
    {
        return clone $this->_getJobStateService();
    }
}