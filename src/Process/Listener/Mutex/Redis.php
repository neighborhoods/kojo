<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Listener\Mutex;

use Neighborhoods\Kojo\Message\Broker\RepositoryInterface;
use Neighborhoods\Kojo\Process\Forked;
use Neighborhoods\Kojo\Process\ListenerInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Redis\Factory;
use Neighborhoods\Kojo\Message;

class Redis extends Forked implements RedisInterface
{
    use Factory\AwareTrait;
    use Message\Broker\Repository\AwareTrait;

    protected $redis;

    protected function run(): Forked
    {
        $this->_register();

        return $this;
    }

    protected function _register(): ProcessInterface
    {
        $this->getRedis()->client('SETNAME', $this->getParentProcessUuid());
        $messageBroker = $this->getMessageBrokerRepository()->get(RepositoryInterface::ID_CORE);
        $messageBroker->setPublishChannelName($this->getParentProcessUuid());
        $messageBroker->setSubscriptionChannelName($this->getParentProcessUuid());
        $messageBroker->waitForNewMessage();
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

    protected function getRedis(): \Redis
    {
        if ($this->redis === null) {
            $this->redis = $this->getRedisFactory()->create();
        }

        return $this->redis;
    }
}