<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker;

use Neighborhoods\Kojo\Process\Pool\Logger;
use Neighborhoods\Pylon\Data\Property\Defensive;

abstract class BrokerAbstract implements BrokerInterface
{
    use Defensive\AwareTrait;
    use Logger\AwareTrait;
    protected $_publishChannelName;
    protected $_subscriptionChannelName;

    public function setSubscriptionChannelName(string $channelName): BrokerInterface
    {
        if ($this->_subscriptionChannelName === null) {
            $this->_subscriptionChannelName = $channelName;
        }else {
            throw new \LogicException('Subscription channel name is already set.');
        }

        return $this;
    }

    protected function _getSubscriptionChannelName(): string
    {
        if ($this->_subscriptionChannelName === null) {
            throw new \LogicException('Subscription channel name is not set.');
        }

        return $this->_subscriptionChannelName;
    }

    public function setPublishChannelName(string $channelName): BrokerInterface
    {
        if ($this->_publishChannelName === null) {
            $this->_publishChannelName = $channelName;
        }

        return $this;
    }

    protected function _getPublishChannelName(): string
    {
        if ($this->_publishChannelName === null) {
            throw new \LogicException('Publish channel name is not set.');
        }

        return $this->_publishChannelName;
    }
}