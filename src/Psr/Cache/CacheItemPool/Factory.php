<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Psr\Cache\CacheItemPool;

use Psr\Cache\CacheItemPoolInterface;
use Neighborhoods\Kojo\Redis;
use Symfony\Component\Cache\Adapter\RedisAdapter;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use Redis\Repository\AwareTrait;

    public function create(): CacheItemPoolInterface
    {
        $redis = clone $this->getRedisRepository()->get(CacheItemPoolInterface::class);

        return new RedisAdapter($redis);
    }
}
