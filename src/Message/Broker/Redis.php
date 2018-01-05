<?php

namespace NHDS\Jobs\Message\Broker;

class Redis extends AbstractBroker
{
    protected $_redisClient;

    public function waitForNewMessage(): BrokerInterface
    {
        try{
            if (!$this->hasMessage()) {
                $this->_getRedisClient()->brpoplpush(
                    $this->_getSubscriptionChannelName(),
                    'channel_listener_PID_messages',
                    0
                );
            }
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
            $hasMessage = $this->_getRedisClient()->lLen('channel_listener_PID_messages');
        }catch(\Exception $exception){
            $this->_getLogger()->warning($exception->getMessage());
            throw $exception;
        }

        return (bool)$hasMessage;
    }

    public function getNextMessage(): array
    {
        try{
            $messages = [$this->_getRedisClient()->rPop('channel_listener_PID_messages')];
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
            $this->_getRedisClient()->rPush($this->_getPublishChannelName(), $message);
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