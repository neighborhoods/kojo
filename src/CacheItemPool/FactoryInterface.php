<?php
declare(strict_types=1);

namespace NHDS\Jobs\CacheItemPool;

use NHDS\Jobs\Redis\RepositoryInterface;
use NHDS\Jobs\Service;
use Psr\Cache\CacheItemPoolInterface;

interface FactoryInterface extends Service\FactoryInterface
{
    public function create(): CacheItemPoolInterface;

    public function setRedisRepository(RepositoryInterface $redisRepository);
}