<?php

namespace NHDS\Jobs\Message\Broker;

use NHDS\Jobs\Process\Pool\Logger;
use NHDS\Toolkit\Data\Property\Strict;

abstract class BrokerAbstract implements BrokerInterface
{
    use Strict\AwareTrait;
    use Logger\AwareTrait;
    protected $_publishChannelName;
    protected $_subscriptionChannelName;
    protected $_host;
    protected $_port;

    public function setPort(string $port): BrokerInterface
    {
        if ($this->_port === null) {
            $this->_port = $port;
        }else {
            throw new \LogicException('Port is already set.');
        }

        return $this;
    }

    public function setHost(string $host): BrokerInterface
    {
        if ($this->_host === null) {
            $this->_host = $host;
        }else {
            throw new \LogicException('Host is already set.');
        }

        return $this;
    }

    public function setSubscriptionChannelName(string $channelName): BrokerInterface
    {
        if ($this->_subscriptionChannelName === null) {
            $this->_subscriptionChannelName = $channelName;
        }else {
            throw new \LogicException('Subscription channel name is already set.');
        }

        return $this;
    }

    public function setPublishChannelName(string $channelName): BrokerInterface
    {
        if ($this->_publishChannelName === null) {
            $this->_publishChannelName = $channelName;
        }

        return $this;
    }

    protected function _getHost(): string
    {
        if ($this->_host === null) {
            throw new \LogicException('Host is not set.');
        }

        return $this->_host;
    }

    protected function _getSubscriptionChannelName(): string
    {
        if ($this->_subscriptionChannelName === null) {
            throw new \LogicException('Subscription channel name is not set.');
        }

        return $this->_subscriptionChannelName;
    }

    protected function _getPublishChannelName(): string
    {
        if ($this->_publishChannelName === null) {
            throw new \LogicException('Publish channel name is not set.');
        }

        return $this->_publishChannelName;
    }

    protected function _getPort(): string
    {
        if ($this->_port === null) {
            throw new \LogicException('Port is not set.');
        }

        return $this->_port;
    }
}