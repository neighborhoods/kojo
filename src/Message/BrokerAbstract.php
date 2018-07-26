<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message;

use Neighborhoods\Kojo\Logger;

abstract class BrokerAbstract implements BrokerInterface
{
    use Logger\AwareTrait;
    protected $publishChannelName;
    protected $subscriptionChannelName;

    public function setSubscriptionChannelName(string $subscriptionChannelName): BrokerInterface
    {
        if ($this->subscriptionChannelName === null) {
            $this->subscriptionChannelName = $subscriptionChannelName;
        } else {
            throw new \LogicException('Subscription channel name is already set.');
        }

        return $this;
    }

    protected function getSubscriptionChannelName(): string
    {
        if ($this->subscriptionChannelName === null) {
            throw new \LogicException('Subscription channel name is not set.');
        }

        return $this->subscriptionChannelName;
    }

    public function setPublishChannelName(string $publishChannelName): BrokerInterface
    {
        if ($this->publishChannelName === null) {
            $this->publishChannelName = $publishChannelName;
        } else {
            throw new \LogicException('Publish channel name is already set.');
        }

        return $this;
    }

    protected function getPublishChannelName(): string
    {
        if ($this->publishChannelName === null) {
            throw new \LogicException('Publish channel name is not set.');
        }

        return $this->publishChannelName;
    }
}