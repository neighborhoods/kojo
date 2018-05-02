<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\CacheItemPool;

use Psr\Cache\CacheItemPoolInterface;

interface RepositoryInterface
{
    public function getById(string $id): CacheItemPoolInterface;

    public function setCacheItemPoolFactory(FactoryInterface $cacheItemPoolFactory);
}