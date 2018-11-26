<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

interface NotificationInterface
{
    public function setThrowable(\Throwable $throwable): NotificationInterface;

    public function hasThrowable(): bool;

    public function getThrowable(): \Throwable;

    public function setLevel(string $level): NotificationInterface;

    public function hasLevel(): bool;

    public function getLevel(): string;

    public function setMessage(string $message): NotificationInterface;

    public function hasMessage(): bool;

    public function getMessage(): string;

    public function setContext(\JsonSerializable $context): NotificationInterface;

    public function hasContext(): bool;

    public function getContext(): \JsonSerializable;
}
