<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Connection\Container\Repository;

use Neighborhoods\Kojo\Db\Connection\Container\RepositoryInterface;

trait AwareTrait
{
    public function setDbConnectionContainerRepository(RepositoryInterface $dbConnectionContainerRepository): self
    {
        $this->_create(RepositoryInterface::class, $dbConnectionContainerRepository);

        return $this;
    }

    protected function _getDbConnectionContainerRepository(): RepositoryInterface
    {
        return $this->_read(RepositoryInterface::class);
    }

    protected function _getDbConnectionContainerRepositoryClone(): RepositoryInterface
    {
        return clone $this->_getDbConnectionContainerRepository();
    }

    protected function _hasDbConnectionContainerRepository(): bool
    {
        return $this->_exists(RepositoryInterface::class);
    }

    protected function _unsetDbConnectionContainerRepository(): self
    {
        $this->_delete(RepositoryInterface::class);

        return $this;
    }
}