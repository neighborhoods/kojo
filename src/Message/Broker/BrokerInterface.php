<?php

namespace NHDS\Jobs\Message\Broker;

interface BrokerInterface
{
    public function waitForNewMessage(): BrokerInterface;

    public function publishMessage($message): BrokerInterface;

    public function hasMessage(): bool;

    public function getNextMessage(): string;

    public function getPublishChannelLength(): int;
}