<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker\Delegate\Factory;

use Neighborhoods\KojoExample\Worker\Delegate\FactoryInterface;

trait AwareTrait
{
    public function setWorkerDelegateFactory(FactoryInterface $workerDelegateFactory): self
    {
        $this->_create(FactoryInterface::class, $workerDelegateFactory);

        return $this;
    }

    protected function _getWorkerDelegateFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _getWorkerDelegateFactoryClone(): FactoryInterface
    {
        return clone $this->_getWorkerDelegateFactory();
    }

    protected function _hasWorkerDelegateFactory(): bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _unsetWorkerDelegateFactory(): self
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}