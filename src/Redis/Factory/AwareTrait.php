<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis\Factory;

use Neighborhoods\Kojo\Redis\FactoryInterface;

trait AwareTrait
{
    public function setRedisFactory(FactoryInterface $factory)
    {
        $this->_create(FactoryInterface::class, $factory);

        return $this;
    }

    protected function _hasRedisFactory(): bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _getRedisFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _getRedisFactoryClone(): FactoryInterface
    {
        return clone $this->_getRedisFactory();
    }

    protected function _unsetRedisFactory()
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}