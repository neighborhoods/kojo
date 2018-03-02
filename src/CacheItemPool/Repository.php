<?php
declare(strict_types=1);

namespace NHDS\Jobs\CacheItemPool;

use NHDS\Jobs\CacheItemPool;
use Psr\Cache\CacheItemPoolInterface;

class Repository implements RepositoryInterface
{
    use CacheItemPool\Factory\AwareTrait;
    protected $_cacheItemPoolCollection = [];

    public function getById(string $id): CacheItemPoolInterface
    {
        if (!isset($this->_cacheItemPoolCollection[$id])) {
            $this->_cacheItemPoolCollection[$id] = $this->_getCacheItemPoolFactory();
        }

        return $this->_cacheItemPoolCollection[$id];
    }
}