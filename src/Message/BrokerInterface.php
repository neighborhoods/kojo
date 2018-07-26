<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message;

interface BrokerInterface
{
    public function waitForNewMessage(): BrokerInterface;

    public function publishMessage($message): BrokerInterface;

    public function hasMessage(): bool;

    public function getNextMessage(): string;

    public function getPublishChannelLength(): int;

    public function getSubscriptionChannelLength(): int;

    public function setSubscriptionChannelName(string $subscriptionChannelName): BrokerInterface;

    public function setPublishChannelName(string $publishChannelName): BrokerInterface;
}