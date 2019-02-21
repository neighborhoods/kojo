<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Listener\Mutex;

use Neighborhoods\Kojo\Process\Forked;
use Neighborhoods\Kojo\Process\ListenerAbstract;
use Neighborhoods\Kojo\Process\ListenerInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Redis\Factory;

class Redis extends ListenerAbstract implements RedisInterface
{
    use Factory\AwareTrait;
    const PROP_REDIS = 'redis';

    protected function _run(): Forked
    {
        $this->_getProcessSignal()->setCanBufferSignals(false);
        try {
            $this->_register();
        } catch (\Throwable $throwable) {
            posix_kill($this->getParentProcessId(), $this->getParentProcessTerminationSignalNumber());
            $this->_getLogger()->critical(
                'Redis mutex watchdog registration encountered an exception.',
                [(string)$throwable]
            );
            $this->shutdown();
        }

        return $this;
    }

    protected function _register(): ProcessInterface
    {
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
