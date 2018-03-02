<?php
declare(strict_types=1);

namespace NHDS\Jobs\Semaphore\Mutex;

use NHDS\Jobs\Semaphore\MutexAbstract;
use NHDS\Jobs\Semaphore\MutexInterface;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Process\Pool\Logger;
use NHDS\Jobs\Process;

class Redis extends MutexAbstract implements RedisInterface
{
    use Strict\AwareTrait;
    use Logger\AwareTrait;
    use Process\Registry\AwareTrait;
    const PROP_REDIS = 'redis';
    const PROP_KEY   = 'key';
    protected $_hasLock = false;

    public function testAndSetLock(): bool
    {
        if ($this->_hasLock === false) {
            $this->_getRedis()->watch($this->_getKey());

            // If the mutex resource ID is set, then check if the owning client is connected.
            $mutexKeyValue = $this->_getRedis()->get($this->_getKey());
            if (!empty($mutexKeyValue)) {
                $mutexClientIsConnected = false;

                // Get a list of connected clients.
                $clients = $this->_getRedis()->client('LIST');
                foreach ($clients as $client) {
                    if ($client['name'] === $mutexKeyValue) {
                        $mutexClientIsConnected = true;
                        break;
                    }
                }

                // If the client that registered for the mutex resource ID is connected, the mutex is held by another client.
                if ($mutexClientIsConnected === false) {
                    // If not, try to obtain the lock by registering on the mutex resource ID.
                    $this->_getRedis()->multi();
                    $this->_getRedis()->set($this->_getKey(), $this->_getParentProcessUuid());
                    $reply = $this->_getRedis()->exec();

                    // If the mutex resource ID was not set by another client, the mutex is obtained by this client.
                    if ($reply[0] === true) {
                        $this->_hasLock = true;
                        $this->_getLogger()->debug("Obtained mutex[{$this->_getKey()}].");
                    }else {
                        $this->_getLogger()->debug("Did not obtain mutex[{$this->_getKey()}].");
                    }
                }else {
                    $this->_getLogger()->debug("Did not obtain mutex[{$this->_getKey()}].");
                }
            }else {
                // If the mutex resource ID is not set, try to obtain the mutex.
                $this->_getRedis()->multi();
                $this->_getRedis()->set($this->_getKey(), $this->_getParentProcessUuid());
                $reply = $this->_getRedis()->exec();
                if (is_array($reply) && $reply[0] === true) {
                    $this->_hasLock = true;
                    $this->_getLogger()->debug("Obtained mutex[{$this->_getKey()}].");
                }elseif (is_bool($reply) && $reply === false) {
                    $this->_getLogger()->debug("Did not obtain mutex[{$this->_getKey()}].");
                }else {
                    $type = gettype($reply);
                    throw new \UnexpectedValueException("Reply is of type [$type]");
                }
            }
        }else {
            throw new \LogicException('The mutex already has obtained a lock.');
        }

        return $this->_hasLock;
    }

    public function releaseLock(): MutexInterface
    {
        if ($this->_hasLock === true) {
            $this->_getRedis()->del($this->_getKey());
            $this->_getLogger()->debug("Released mutex[{$this->_getKey()}].");
            $this->_hasLock = false;
        }else {
            throw new \LogicException('The mutex has not obtained a lock.');
        }

        return $this;
    }

    public function hasLock(): bool
    {
        return $this->_hasLock;
    }

    protected function _getParentProcessUuid(): string
    {
        return $this->_getProcessRegistry()->getLastRegisteredProcess()->getUuid();
    }

    protected function _getKey(): string
    {
        if (!$this->_exists(self::PROP_KEY)) {
            $key = '/' . $this->_getResource()->getResourcePath() . '/' . $this->_getResource()->getResourceName();
            $this->_create(self::PROP_KEY, $key);
        }

        return $this->_read(self::PROP_KEY);
    }

    protected function _getRedis(): \Redis
    {
        if (!$this->_exists(self::PROP_REDIS)) {
            // Connect to Redis.
            $redis = new \Redis();
            $redis->connect('redis');
            $redis->setOption(\Redis::OPT_READ_TIMEOUT, '-1');
            $this->_create(self::PROP_REDIS, $redis);
        }

        return $this->_read(self::PROP_REDIS);
    }

    public function setRedis(\Redis $redis): RedisInterface
    {
//        $this->_create(self::PROP_REDIS, $redis);

        return $this;
    }
}