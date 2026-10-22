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

    private const BRPOPLPUSH_TIMEOUT_SECONDS = 61;

    public function waitForNewMessage(): BrokerInterface
    {
        try {
            while (true) {
                $start = microtime(true);
                $result = $this->_getRedisClient()->brpoplpush(
                    $this->_getPublishChannelName(),
                    $this->_getSubscriptionChannelName(),
                    self::BRPOPLPUSH_TIMEOUT_SECONDS
                );
                if ($result !== false) {
                    break;
                }
                $elapsed = microtime(true) - $start;
                if ($elapsed < self::BRPOPLPUSH_TIMEOUT_SECONDS - 1) {
                    sleep((int)(self::BRPOPLPUSH_TIMEOUT_SECONDS - 1 - $elapsed));
                }
                $this->_redisClient = $this->_getRedisRepository()->ensureConnected($this->_redisClient);
            }
        } catch (\Throwable $throwable) {
            $this->_getLogger()->critical($throwable->getMessage(), ['exception' => $throwable]);
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
            $this->_getLogger()->critical($throwable->getMessage(), ['exception' => $throwable]);
            throw $throwable;
        }

        return ($publishChannelLength + $subscriptionChannelLength > 0);
    }

    public function attemptGetNextMessage(): ?string
    {
        try {
            $subscriptionMessage = $this->_getRedisClient()->lPop($this->_getSubscriptionChannelName());

            if ($subscriptionMessage !== false) {
                return $subscriptionMessage;
            }

            $publicationMessage = $this->_getRedisClient()->rPop($this->_getPublishChannelName());

            if ($publicationMessage !== false) {
                return $publicationMessage;
            }

            return null;
        } catch (\Throwable $throwable) {
            $this->_getLogger()->critical($throwable->getMessage(), ['exception' => $throwable]);
            throw $throwable;
        }
    }

    public function getPublishChannelLength(): int
    {
        try {
            $publishChannelLength = $this->_getRedisClient()->lLen($this->_getPublishChannelName());
        } catch (\Throwable $throwable) {
            $this->_getLogger()->critical($throwable->getMessage(), ['exception' => $throwable]);
            throw $throwable;
        }

        return $publishChannelLength;
    }

    public function getSubscriptionChannelLength(): int
    {
        try {
            $subscriptionChannelLength = $this->_getRedisClient()->lLen($this->_getSubscriptionChannelName());
        } catch (\Throwable $throwable) {
            $this->_getLogger()->critical($throwable->getMessage(), ['exception' => $throwable]);
            throw $throwable;
        }

        return $subscriptionChannelLength;
    }

    public function publishMessage($message): BrokerInterface
    {
        try {
            $this->_getRedisClient()->lPush($this->_getPublishChannelName(), $message);
        } catch (\Throwable $throwable) {
            $this->_getLogger()->critical($throwable->getMessage(), ['exception' => $throwable]);
            throw $throwable;
        }

        return $this;
    }
}
