<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis;

use Neighborhoods\Kojo\Redis;
use Neighborhoods\Kojo\Process;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Repository implements RepositoryInterface
{
    use Defensive\AwareTrait;
    use Redis\Factory\AwareTrait;
    use Process\Registry\AwareTrait;
    protected $_redisCollection = [];

    public function getById(string $id): \Redis
    {
        $id .= $this->_getProcessRegistry()->getLastRegisteredProcess()->getUuid();
        if (!isset($this->_redisCollection[$id])) {
            $this->_redisCollection[$id] = $this->_getRedisFactory()->create();
        }

        return $this->_redisCollection[$id];
    }

    public function ensureConnected(\Redis $redis): \Redis
    {
        $key = array_search($redis, $this->_redisCollection, true);
        try {
            $redis->ping();
            return $redis;
        } catch (\Throwable $throwable) {
            try {
                $redis->close();
            } catch (\Throwable $ignored) {
            }
            $fresh = $this->_getRedisFactory()->create();
            if ($key !== false) {
                $this->_redisCollection[$key] = $fresh;
            }
            return $fresh;
        }
    }
}