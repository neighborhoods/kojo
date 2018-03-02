<?php
declare(strict_types=1);

namespace NHDS\Jobs\Redis;

use NHDS\Jobs\Redis;

class Repository
{
    use Redis\Factory\AwareTrait;
    protected $_redisCollection = [];

    public function getById(string $id): \Redis
    {
        if (!isset($this->_redisCollection[$id])) {
            $this->_redisCollection[$id] = $this->_getRedisFactory()->create();
        }

        return $this->_redisCollection[$id];
    }
}