<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker;

interface BrokerInterface
{
    public function waitForNewMessage(): BrokerInterface;

    public function publishMessage($message): BrokerInterface;

    public function hasMessage(): bool;

    public function getNextMessage(): string;

    public function getPublishChannelLength(): int;

    public function getSubscriptionChannelLength(): int;

    public function setSubscriptionChannelName(string $channelName): BrokerInterface;

    public function setPublishChannelName(string $channelName): BrokerInterface;
}