<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Listener\Mutex;

use NHDS\Jobs\Process\Forked;
use NHDS\Jobs\Process\ListenerAbstract;
use NHDS\Jobs\Process\ListenerInterface;
use NHDS\Jobs\ProcessInterface;
use NHDS\Jobs\Redis\Factory;

class Redis extends ListenerAbstract implements RedisInterface
{
    use Factory\AwareTrait;
    const PROP_REDIS = 'redis';

    protected function _run(): Forked
    {
        $this->_register();

        return $this;
    }

    protected function _register(): ProcessInterface
    {
        $this->_getLogger()->debug("CLIENT SETNAME {$this->getParentProcessUuid()}");
        $this->_getRedis()->client('SETNAME', $this->getParentProcessUuid());
        $this->_getMessageBroker()->setPublishChannelName($this->getParentProcessUuid());
        $this->_getMessageBroker()->setSubscriptionChannelName($this->getParentProcessUuid());
        $this->_getMessageBroker()->waitForNewMessage();
        posix_kill($this->getParentProcessId(), $this->getParentProcessTerminationSignalNumber());

        return $this;
    }

    public function processMessages(): ListenerInterface
    {
        throw new \RuntimeException('The connection to redis was lost.');
    }

    public function hasMessages(): bool
    {
        return true;
    }

    protected function _getRedis(): \Redis
    {
        if (!$this->_exists(self::PROP_REDIS)) {
            $this->_create(self::PROP_REDIS, $this->_getRedisFactory()->create());
        }

        return $this->_read(self::PROP_REDIS);
    }
}