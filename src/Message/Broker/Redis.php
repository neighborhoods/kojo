<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker;

use Neighborhoods\Kojo\Process\Pool\Logger;
use Neighborhoods\Kojo\Redis\Repository;

class Redis extends BrokerAbstract
{
    use Logger\AwareTrait;
    use Repository\AwareTrait;
    protected $_redisClient;

    public function waitForNewMessage(): BrokerInterface
    {
        try {
            $this->_getRedisClient()->brpoplpush(
                $this->_getPublishChannelName(),
                $this->_getSubscriptionChannelName(),
                0
            );
        } catch (\Throwable $throwable) {
            $this->_getLogger()->critical($throwable->getMessage(), [(string)$throwable]);
            throw $throwable;
        }

        return $this;
    }

    protected function _getRedisClient(): \Redis
    {
        if ($this->_redisClient === null) {
            $this->_redisClient = $this->_getRedisRepository()->getById(BrokerInterface::class);
        }

        return $this->_redisClient;
    }

    public function hasMessage(): bool
    {
        try {
            $publishChannelLength = $this->getPublishChannelLength();
            $subscriptionChannelLength = $this->getSubscriptionChannelLength();
        } catch (\Throwable $throwable) {
            $this->_getLogger()->critical($throwable->getMessage(), [(string)$throwable]);
            throw $throwable;
        }

        return $publishChannelLength + $subscriptionChannelLength > 0 ? true : false;
    }

    public function getNextMessage(): string
    {
        try {
            $message = $this->_getRedisClient()->lPop($this->_getSubscriptionChannelName());
            if ($message === false) {
                $message = $this->_getRedisClient()->rPop($this->_getPublishChannelName());
            }
        } catch (\Throwable $throwable) {
            $this->_getLogger()->critical($throwable->getMessage(), [(string)$throwable]);
            throw $throwable;
        }

        return (string)$message;
    }

    public function getPublishChannelLength(): int
    {
        try {
            $publishChannelLength = $this->_getRedisClient()->lLen($this->_getPublishChannelName());
        } catch (\Throwable $throwable) {
            $this->_getLogger()->critical($throwable->getMessage(), [(string)$throwable]);
            throw $throwable;
        }

        return $publishChannelLength;
    }

    public function getSubscriptionChannelLength(): int
    {
        try {
            $subscriptionChannelLength = $this->_getRedisClient()->lLen($this->_getSubscriptionChannelName());
        } catch (\Throwable $throwable) {
            $this->_getLogger()->critical($throwable->getMessage(), [(string)$throwable]);
            throw $throwable;
        }

        return $subscriptionChannelLength;
    }

    public function publishMessage($message): BrokerInterface
    {
        try {
            $this->_getRedisClient()->lPush($this->_getPublishChannelName(), $message);
        } catch (\Throwable $throwable) {
            $this->_getLogger()->critical($throwable->getMessage(), [(string)$throwable]);
            throw $throwable;
        }

        return $this;
    }
}
