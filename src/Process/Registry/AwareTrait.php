<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Registry;

use NHDS\Jobs\Process\RegistryInterface;

trait AwareTrait
{
    public function setProcessRegistry(RegistryInterface $registry)
    {
        $this->_create(RegistryInterface::class, $registry);

        return $this;
    }

    protected function _getProcessRegistry(): RegistryInterface
    {
        return $this->_read(RegistryInterface::class);
    }

    protected function _getProcessRegistryClone(): RegistryInterface
    {
        return clone $this->_getProcessRegistry();
    }

    protected function _unsetProcessRegistry()
    {
        $this->_delete(RegistryInterface::class);

        return $this;
    }
}