<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

class Notification implements NotificationInterface
{
    protected $throwable;
    protected $level;
    protected $notify;
    protected $message;
    protected $context;

    public function setThrowable(\Throwable $throwable): NotificationInterface
    {
        if ($this->throwable !== null) {
            throw new \LogicException('Notification throwable is already set.');
        }
        $this->throwable = $throwable;

        return $this;
    }

    public function hasThrowable(): bool
    {
        return $this->throwable !== null;
    }

    public function getThrowable(): \Throwable
    {
        if ($this->throwable === null) {
            throw new \LogicException('Notification throwable has not been set.');
        }

        return $this->throwable;
    }

    public function setLevel(string $level): NotificationInterface
    {
        if ($this->level !== null) {
            throw new \LogicException('Notification level is already set.');
        }
        $this->level = $level;

        return $this;
    }

    public function hasLevel(): bool
    {
        return $this->level !== null;
    }

    public function getLevel(): string
    {
        if ($this->level === null) {
            throw new \LogicException('Notification level has not been set.');
        }

        return $this->level;
    }

    public function setMessage(string $message): NotificationInterface
    {
        if ($this->message !== null) {
            throw new \LogicException('Notification message is already set.');
        }
        $this->message = $message;

        return $this;
    }

    public function hasMessage(): bool
    {
        return $this->message !== null;
    }

    public function getMessage(): string
    {
        if ($this->message === null) {
            throw new \LogicException('Notification message has not been set.');
        }

        return $this->message;
    }

    public function setContext(\JsonSerializable $context): NotificationInterface
    {
        if ($this->context !== null) {
            throw new \LogicException('Notification context is already set.');
        }
        $this->context = $context;

        return $this;
    }

    public function hasContext(): bool
    {
        return $this->context !== null;
    }

    public function getContext(): \JsonSerializable
    {
        if ($this->context === null) {
            throw new \LogicException('Notification context has not been set.');
        }

        return $this->context;
    }
}
