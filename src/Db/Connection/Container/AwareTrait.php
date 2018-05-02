<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Connection\Container;

use Neighborhoods\Kojo\Db\Connection\ContainerInterface;

trait AwareTrait
{
    public function setDbConnectionContainer(ContainerInterface $dbConnectionContainer): self
    {
        $this->_create(ContainerInterface::class, $dbConnectionContainer);

        return $this;
    }

    protected function _getDbConnectionContainer(): ContainerInterface
    {
        return $this->_read(ContainerInterface::class);
    }

    protected function _getDbConnectionContainerClone(): ContainerInterface
    {
        return clone $this->_getDbConnectionContainer();
    }

    protected function _hasDbConnectionContainer(): bool
    {
        return $this->_exists(ContainerInterface::class);
    }

    protected function _unsetDbConnectionContainer(): self
    {
        $this->_delete(ContainerInterface::class);

        return $this;
    }
}