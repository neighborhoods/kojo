<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Mutex;

use Neighborhoods\Kojo\Semaphore\MutexAbstract;
use Neighborhoods\Kojo\Semaphore\MutexInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Kojo\Process\Pool\Logger;
use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\Redis\Repository;

class Redis extends MutexAbstract implements RedisInterface
{
    use Defensive\AwareTrait;
    use Logger\AwareTrait;
    use Process\Registry\AwareTrait;
    use Repository\AwareTrait;
    const PROP_REDIS = 'redis';
    const PROP_KEY   = 'key';
    protected $_hasLock = false;

    public function testAndSetLock(): bool
    {
        if ($this->_hasLock === false) {
            $key = $this->_getKey();
            $processUUID = $this->_getProcessUuid();
            $this->_getRedisClient()->watch($key);

            // If the mutex resource ID is set, then check if the owning client is connected.
            $mutexKeyValue = $this->_getRedisClient()->get($key);
            if (!empty($mutexKeyValue)) {
                $mutexClientIsConnected = false;

                // Get a list of connected clients.
                $clients = $this->_getRedisClient()->client('LIST');
                foreach ($clients as $client) {
                    if ($client['name'] === $mutexKeyValue) {
                        $mutexClientIsConnected = true;
                        break;
                    }
                }

                // If the client that registered for the mutex resource ID is connected, the mutex is held by another client.
                if ($mutexClientIsConnected === false) {
                    // If not, try to obtain the lock by registering on the mutex resource ID.
                    $this->_getRedisClient()->multi();
                    $this->_getRedisClient()->set($key, $processUUID);
                    $reply = $this->_getRedisClient()->exec();

                    // If the mutex resource ID was not set by another client, the mutex is obtained by this client.
                    if ($reply[0] === true) {
                        $this->_hasLock = true;
                    }
                }
            }else {
                // If the mutex resource ID is not set, try to obtain the mutex.
                $this->_getRedisClient()->multi();
                $this->_getRedisClient()->set($key, $processUUID);
                $reply = $this->_getRedisClient()->exec();
                if (is_array($reply) && $reply[0] === true) {
                    $this->_hasLock = true;
                }elseif ($reply !== false) {
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
            $this->_getRedisClient()->del($this->_getKey());
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

    protected function _getProcessUuid(): string
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

    protected function _getRedisClient(): \Redis
    {
        if (!$this->_exists(self::PROP_REDIS)) {
            $redis = $this->_getRedisRepository()->getById(RedisInterface::class);
            $redis->client('SETNAME', $this->_getProcessUuid());
            $this->_create(self::PROP_REDIS, $redis);
        }

        return $this->_read(self::PROP_REDIS);
    }
}