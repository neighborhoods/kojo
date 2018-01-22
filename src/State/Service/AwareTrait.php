<?php
declare(strict_types=1);

namespace NHDS\Jobs\State\Service;

use NHDS\Jobs\State\ServiceInterface;

trait AwareTrait
{
    public function setStateService(ServiceInterface $stateService)
    {
        $this->_create(ServiceInterface::class, $stateService);

        return $this;
    }

    protected function _getStateService(): ServiceInterface
    {
        return $this->_read(ServiceInterface::class);
    }

    protected function _getStateServiceClone(): ServiceInterface
    {
        return clone $this->_getStateService();
    }

    protected function _unsetStateService()
    {
        $this->_delete(ServiceInterface::class);

        return $this;
    }
}