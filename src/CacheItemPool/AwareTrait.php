<?php
declare(strict_types=1);

namespace NHDS\Jobs\CacheItemPool;

use Psr\Cache\CacheItemPoolInterface;

trait AwareTrait
{
    public function setCacheItemPool(CacheItemPoolInterface $cacheItemPool): self
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

    protected function _hasCacheItemPool(): bool
    {
        return $this->_exists(CacheItemPoolInterface::class);
    }

    protected function _unsetCacheItemPool(): self
    {
        $this->_delete(CacheItemPoolInterface::class);

        return $this;
    }
}