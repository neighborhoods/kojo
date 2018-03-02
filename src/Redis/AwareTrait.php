<?php
declare(strict_types=1);

namespace NHDS\Jobs\Redis;

trait AwareTrait
{
    public function setRedis(\Redis $redis): self
    {
        $this->_create(\Redis::class, $redis);

        return $this;
    }

    protected function _hasRedis(): bool
    {
        return $this->_exists(\Redis::class);
    }

    protected function _getRedis(): \Redis
    {
        return $this->_read(\Redis::class);
    }

    protected function _getRedisClone(): \Redis
    {
        return clone $this->_getRedis();
    }

    protected function _unsetRedis(): self
    {
        $this->_delete(\Redis::class);

        return $this;
    }
}