<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker\Delegate;

use Neighborhoods\KojoExample\Worker\DelegateInterface;

trait AwareTrait
{
    public function setWorkerDelegate(DelegateInterface $workerDelegate): self
    {
        $this->_create(DelegateInterface::class, $workerDelegate);

        return $this;
    }

    protected function _getWorkerDelegate(): DelegateInterface
    {
        return $this->_read(DelegateInterface::class);
    }

    protected function _getWorkerDelegateClone(): DelegateInterface
    {
        return clone $this->_getWorkerDelegate();
    }

    protected function _hasWorkerDelegate(): bool
    {
        return $this->_exists(DelegateInterface::class);
    }

    protected function _unsetWorkerDelegate(): self
    {
        $this->_delete(DelegateInterface::class);

        return $this;
    }
}