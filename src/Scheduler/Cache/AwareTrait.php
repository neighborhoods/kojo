<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Scheduler\Cache;

use Neighborhoods\Kojo\Scheduler\CacheInterface;

trait AwareTrait
{
    public function setSchedulerCache(CacheInterface $schedulerCache)
    {
        $this->_create(CacheInterface::class, $schedulerCache);

        return $this;
    }

    protected function _getSchedulerCache(): CacheInterface
    {
        return $this->_read(CacheInterface::class);
    }

    protected function _getSchedulerCacheClone(): CacheInterface
    {
        return clone $this->_getSchedulerCache();
    }

    protected function _hasSchedulerCache(): bool
    {
        return $this->_exists(CacheInterface::class);
    }

    protected function _unsetSchedulerCache()
    {
        $this->_delete(CacheInterface::class);

        return $this;
    }
}