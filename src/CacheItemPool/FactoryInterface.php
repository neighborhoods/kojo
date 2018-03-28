<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\CacheItemPool;

use Neighborhoods\Kojo\Redis\RepositoryInterface;
use Neighborhoods\Kojo\Service;
use Psr\Cache\CacheItemPoolInterface;

interface FactoryInterface extends Service\FactoryInterface
{
    public function create(): CacheItemPoolInterface;

    public function setRedisRepository(RepositoryInterface $redisRepository);
}