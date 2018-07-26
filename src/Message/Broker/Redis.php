<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker;

use Neighborhoods\Kojo\Logger;
use Neighborhoods\Kojo\Redis\Repository;
use Neighborhoods\Kojo\Message\BrokerAbstract;
use Neighborhoods\Kojo\Message\BrokerInterface;

class Redis extends BrokerAbstract
{
    use Logger\AwareTrait;
    use Repository\AwareTrait;
    protected $redisClient;

    public function waitForNewMessage(): BrokerInterface
    {
        try {
            $this->getRedisClient()->brpoplpush(
                $this->getPublishChannelName(),
                $this->getSubscriptionChannelName(),
                0
            );
        } catch (\Exception $exception) {
            $this->getLogger()->critical($exception->getMessage());
            throw $exception;
        }

        return $this;
    }

    protected function getRedisClient(): \Redis
    {
        if ($this->redisClient === null) {
            $this->redisClient = $this->getRedisRepository()->get(BrokerInterface::class);
        }

        return $this->redisClient;
    }

    public function hasMessage(): bool
    {
        try {
            $publishChannelLength = $this->getPublishChannelLength();
            $subscriptionChannelLength = $this->getSubscriptionChannelLength();
        } catch (\Exception $exception) {
            $this->getLogger()->critical($exception->getMessage());
            throw $exception;
        }

        return $publishChannelLength + $subscriptionChannelLength > 0 ? true : false;
    }

    public function getNextMessage(): string
    {
        try {
            $message = $this->getRedisClient()->lPop($this->getSubscriptionChannelName());
            if ($message === false) {
                $message = $this->getRedisClient()->rPop($this->getPublishChannelName());
            }
        } catch (\Exception $exception) {
            $this->getLogger()->critical($exception->getMessage());
            throw $exception;
        }

        return (string)$message;
    }

    public function getPublishChannelLength(): int
    {
        try {
            $publishChannelLength = $this->getRedisClient()->lLen($this->getPublishChannelName());
        } catch (\Exception $exception) {
            $this->getLogger()->critical($exception->getMessage());
            throw $exception;
        }

        return $publishChannelLength;
    }

    public function getSubscriptionChannelLength(): int
    {
        try {
            $subscriptionChannelLength = $this->getRedisClient()->lLen($this->getSubscriptionChannelName());
        } catch (\Exception $exception) {
            $this->getLogger()->critical($exception->getMessage());
            throw $exception;
        }

        return $subscriptionChannelLength;
    }

    public function publishMessage($message): BrokerInterface
    {
        try {
            $this->getRedisClient()->lPush($this->getPublishChannelName(), $message);
        } catch (\Exception $exception) {
            $this->getLogger()->critical($exception->getMessage());
            throw $exception;
        }

        return $this;
    }
}