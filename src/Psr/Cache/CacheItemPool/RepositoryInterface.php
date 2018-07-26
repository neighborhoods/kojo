<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Psr\Cache\CacheItemPool;

use Psr\Cache\CacheItemPoolInterface;

interface RepositoryInterface
{
    public function get(string $id): CacheItemPoolInterface;
}