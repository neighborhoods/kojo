<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\CacheItemPool;

use Neighborhoods\Kojo\CacheItemPool;
use Psr\Cache\CacheItemPoolInterface;
use Neighborhoods\Toolkit\Data\Property\Strict;
use Neighborhoods\Kojo\Process;

class Repository implements RepositoryInterface
{
    use Strict\AwareTrait;
    use Process\Registry\AwareTrait;
    use CacheItemPool\Factory\AwareTrait;
    protected $_cacheItemPoolCollection = [];

    public function getById(string $id): CacheItemPoolInterface
    {
        $id .= $this->_getProcessRegistry()->getLastRegisteredProcess()->getUuid();
        if (!isset($this->_cacheItemPoolCollection[$id])) {
            $this->_cacheItemPoolCollection[$id] = $this->_getCacheItemPoolFactory()->create();
        }

        return $this->_cacheItemPoolCollection[$id];
    }
}