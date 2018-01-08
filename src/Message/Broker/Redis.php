<?php

namespace NHDS\Jobs\Message\Broker;

use NHDS\Jobs\Process\Pool\Logger;

class Redis extends AbstractBroker
{
    use Logger\AwareTrait;
    protected $_redisClient;

    public function waitForNewMessage(): BrokerInterface
    {
        try{
            $this->_getRedisClient()->brpoplpush(
                $this->_getPublishChannelName(),
                $this->_getSubscriptionChannelName(),
                0
            );
        }catch(\Exception $exception){
            $this->_getLogger()->warning($exception->getMessage());
            throw $exception;
        }

        return $this;
    }

    protected function _getRedisClient(): \Redis
    {
        if ($this->_redisClient === null) {
            $this->_redisClient = new \Redis();
            // Do not use pconnet.
            $this->_redisClient->connect($this->_getHost(), $this->_getPort());
            $this->_redisClient->setOption(\Redis::OPT_READ_TIMEOUT, '-1');
        }

        return $this->_redisClient;
    }

    public function hasMessage(): bool
    {
        try{
            $listenerStackLength = $this->_getRedisClient()->lLen($this->_getSubscriptionChannelName());
        }catch(\Exception $exception){
            $this->_getLogger()->warning($exception->getMessage());
            throw $exception;
        }

        return $listenerStackLength > 0 ? true : false;
    }

    public function getNextMessage(): string
    {
        try{
            $messages = $this->_getRedisClient()->rPop($this->_getSubscriptionChannelName());
        }catch(\Exception $exception){
            $this->_getLogger()->warning($exception->getMessage());
            throw $exception;
        }

        return $messages;
    }

    public function getPublishChannelLength(): int
    {
        try{
            $publishChannelLength = $this->_getRedisClient()->lLen($this->_getPublishChannelName());
        }catch(\Exception $exception){
            $this->_getLogger()->warning($exception->getMessage());
            throw $exception;
        }

        return $publishChannelLength;
    }

    public function publishMessage($message): BrokerInterface
    {
        try{
            $this->_getRedisClient()->lPush($this->_getPublishChannelName(), $message);
        }catch(\Exception $exception){
            $this->_getLogger()->warning($exception->getMessage());
            throw $exception;
        }

        return $this;
    }

    public function __destruct()
    {
        $this->_getRedisClient()->close();

        return $this;
    }
}