<?php
declare(strict_types=1);

namespace NHDS\Jobs\CacheItemPool;

use Psr\Cache\CacheItemPoolInterface;
use NHDS\Jobs\Service\FactoryAbstract;

class Factory extends FactoryAbstract implements FactoryInterface
{
    public function create(): CacheItemPoolInterface
    {
        // TODO: Implement create() method.
    }
}