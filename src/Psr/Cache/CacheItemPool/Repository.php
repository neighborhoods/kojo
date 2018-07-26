<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Psr\Cache\CacheItemPool;

use Psr\Cache\CacheItemPoolInterface;
use Neighborhoods\Kojo\Psr;
use Neighborhoods\Kojo\Process;

class Repository implements RepositoryInterface
{
    use Process\Registry\AwareTrait;
    use Psr\Cache\CacheItemPool\Factory\AwareTrait;
    use Map\AwareTrait;

    public function get(string $id): CacheItemPoolInterface
    {
        $id .= $this->getProcessRegistry()->getLastRegisteredProcess()->getUuid();
        if (!isset($this->_cacheItemPoolCollection[$id])) {
            $this->getPsrCacheCacheItemPoolMap()[$id] = $this->getPsrCacheCacheItemPoolFactory()->create();
        }

        return $this->getPsrCacheCacheItemPoolMap()[$id];
    }
}