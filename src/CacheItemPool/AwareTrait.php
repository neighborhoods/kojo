<?php

namespace NHDS\Jobs\CacheItemPool;

use Psr\Cache\CacheItemPoolInterface;

trait AwareTrait
{
    public function setCacheItemPool(CacheItemPoolInterface $cacheItemPool)
    {
        $this->_create(CacheItemPoolInterface::class, $cacheItemPool);

        return $this;
    }

    protected function _getCacheItemPool(): CacheItemPoolInterface
    {
        return $this->_read(CacheItemPoolInterface::class);
    }

    protected function _getCacheItemPoolClone(): CacheItemPoolInterface
    {
        return clone $this->_getCacheItemPool();
    }
}