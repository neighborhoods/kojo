<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker\Delegate\Repository;

use Neighborhoods\KojoExample\Worker\Delegate\RepositoryInterface;

trait AwareTrait
{
    public function setWorkerDelegateRepository(RepositoryInterface $workerDelegateRepository): self
    {
        $this->_create(RepositoryInterface::class, $workerDelegateRepository);

        return $this;
    }

    protected function _getWorkerDelegateRepository(): RepositoryInterface
    {
        return $this->_read(RepositoryInterface::class);
    }

    protected function _getWorkerDelegateRepositoryClone(): RepositoryInterface
    {
        return clone $this->_getWorkerDelegateRepository();
    }

    protected function _hasWorkerDelegateRepository(): bool
    {
        return $this->_exists(RepositoryInterface::class);
    }

    protected function _unsetWorkerDelegateRepository(): self
    {
        $this->_delete(RepositoryInterface::class);

        return $this;
    }
}