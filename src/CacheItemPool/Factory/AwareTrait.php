<?php
declare(strict_types=1);

namespace NHDS\Jobs\CacheItemPool\Factory;

use NHDS\Jobs\CacheItemPool\FactoryInterface;

trait AwareTrait
{
    public function setCacheItemPoolFactory(FactoryInterface $cacheItemPoolFactory): self
    {
        $this->_create(FactoryInterface::class, $cacheItemPoolFactory);

        return $this;
    }

    protected function _getCacheItemPoolFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _getCacheItemPoolFactoryClone(): FactoryInterface
    {
        return clone $this->_getCacheItemPoolFactory();
    }

    protected function _hasCacheItemPoolFactory(): bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _unsetCacheItemPoolFactory(): self
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}