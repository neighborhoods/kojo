<?php
declare(strict_types=1);

namespace NHDS\Jobs\CacheItemPool;

use Psr\Cache\CacheItemPoolInterface;

interface RepositoryInterface
{
    public function getById(string $id): CacheItemPoolInterface;
}