<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Registry;

use Neighborhoods\Kojo\Process\RegistryInterface;

trait AwareTrait
{
    public function setProcessRegistry(RegistryInterface $registry): self
    {
        $this->_create(RegistryInterface::class, $registry);

        return $this;
    }

    public function hasProcessRegistry(): bool
    {
        return $this->_exists(RegistryInterface::class);
    }

    protected function _getProcessRegistry(): RegistryInterface
    {
        return $this->_read(RegistryInterface::class);
    }

    protected function _getProcessRegistryClone(): RegistryInterface
    {
        return clone $this->_getProcessRegistry();
    }

    protected function _unsetProcessRegistry(): self
    {
        $this->_delete(RegistryInterface::class);

        return $this;
    }
}