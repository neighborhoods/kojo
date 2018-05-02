<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\CacheItemPool\Repository;

use Neighborhoods\Kojo\CacheItemPool\RepositoryInterface;

trait AwareTrait
{
    public function setCacheItemPoolRepository(RepositoryInterface $cacheItemPoolRepository): self
    {
        $this->_create(RepositoryInterface::class, $cacheItemPoolRepository);

        return $this;
    }

    protected function _getCacheItemPoolRepository(): RepositoryInterface
    {
        return $this->_read(RepositoryInterface::class);
    }

    protected function _getCacheItemPoolRepositoryClone(): RepositoryInterface
    {
        return clone $this->_getCacheItemPoolRepository();
    }

    protected function _hasCacheItemPoolRepository(): bool
    {
        return $this->_exists(RepositoryInterface::class);
    }

    protected function _unsetCacheItemPoolRepository(): self
    {
        $this->_delete(RepositoryInterface::class);

        return $this;
    }
}