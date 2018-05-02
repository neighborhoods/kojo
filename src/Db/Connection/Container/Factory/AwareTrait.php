<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Connection\Container\Factory;

use Neighborhoods\Kojo\Db\Connection\Container\FactoryInterface;

trait AwareTrait
{
    public function setDbConnectionContainerFactory(FactoryInterface $dbConnectionContainerFactory): self
    {
        $this->_create(FactoryInterface::class, $dbConnectionContainerFactory);

        return $this;
    }

    protected function _getDbConnectionContainerFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _getDbConnectionContainerFactoryClone(): FactoryInterface
    {
        return clone $this->_getDbConnectionContainerFactory();
    }

    protected function _hasDbConnectionContainerFactory(): bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _unsetDbConnectionContainerFactory(): self
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}