<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Mutex;

use Neighborhoods\Kojo\Semaphore\MutexAbstract;
use Neighborhoods\Kojo\Semaphore\MutexInterface;
use Neighborhoods\Kojo\Logger;
use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\Redis\Repository;

class Redis extends MutexAbstract implements RedisInterface
{
    use Logger\AwareTrait;
    use Process\Registry\AwareTrait;
    use Repository\AwareTrait;
    protected $hasLock = false;
    protected $key;
    protected $redisClient;

    public function testAndSetLock(): bool
    {
        if ($this->hasLock === false) {
            $key = $this->getKey();
            $processUUID = $this->getProcessUuid();
            $this->getRedisClient()->watch($key);

            // If the mutex resource ID is set, then check if the owning client is connected.
            $mutexKeyValue = $this->getRedisClient()->get($key);
            if (!empty($mutexKeyValue)) {
                $mutexClientIsConnected = false;

                // Get a list of connected clients.
                $clients = $this->getRedisClient()->client('LIST');
                foreach ($clients as $client) {
                    if ($client['name'] === $mutexKeyValue) {
                        $mutexClientIsConnected = true;
                        break;
                    }
                }

                // If the client that registered for the mutex resource ID is connected, the mutex is held by another client.
                if ($mutexClientIsConnected === false) {
                    // If not, try to obtain the lock by registering on the mutex resource ID.
                    $this->getRedisClient()->multi();
                    $this->getRedisClient()->set($key, $processUUID);
                    $reply = $this->getRedisClient()->exec();

                    // If the mutex resource ID was not set by another client, the mutex is obtained by this client.
                    if ($reply[0] === true) {
                        $this->hasLock = true;
                    }
                }
            } else {
                // If the mutex resource ID is not set, try to obtain the mutex.
                $this->getRedisClient()->multi();
                $this->getRedisClient()->set($key, $processUUID);
                $reply = $this->getRedisClient()->exec();
                if (is_array($reply) && $reply[0] === true) {
                    $this->hasLock = true;
                } elseif ($reply !== false) {
                    $type = gettype($reply);
                    throw new \UnexpectedValueException("Reply is of type [$type]");
                }
            }
        } else {
            throw new \LogicException('The mutex already has obtained a lock.');
        }

        return $this->hasLock;
    }

    public function releaseLock(): MutexInterface
    {
        if ($this->hasLock === true) {
            $this->getRedisClient()->del($this->getKey());
            $this->hasLock = false;
        } else {
            throw new \LogicException('The mutex has not obtained a lock.');
        }

        return $this;
    }

    public function hasLock(): bool
    {
        return $this->hasLock;
    }

    protected function getProcessUuid(): string
    {
        return $this->getProcessRegistry()->getLastRegisteredProcess()->getUuid();
    }

    protected function getKey(): string
    {
        if ($this->key === null) {
            $key = '/' . $this->getResource()->getResourcePath() . '/' . $this->getResource()->getResourceName();
            $this->key = $key;
        }

        return $this->key;
    }

    protected function getRedisClient(): \Redis
    {
        if ($this->redisClient === null) {
            $redisClient = $this->getRedisRepository()->get(RedisInterface::class);
            $redisClient->client('SETNAME', $this->getProcessUuid());
            $this->redisClient = $redisClient;
        }

        return $this->redisClient;
    }
}