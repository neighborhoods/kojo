<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\CacheItemPool;

use Psr\Cache\CacheItemPoolInterface;
use Neighborhoods\Kojo\Service\FactoryAbstract;
use Neighborhoods\Kojo\Redis;
use Symfony\Component\Cache\Adapter\RedisAdapter;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Redis\Repository\AwareTrait;

    public function create(): CacheItemPoolInterface
    {
        $redis = $this->_getRedisRepository()->getById(CacheItemPoolInterface::class);

        return new RedisAdapter($redis);
    }
}