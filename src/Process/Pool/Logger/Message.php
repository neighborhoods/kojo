<?php
declare(strict_types=1);


namespace Neighborhoods\Kojo\Process\Pool\Logger;

class Message implements MessageInterface, \JsonSerializable
{
    const KEY_TIME = 'time';
    const KEY_LEVEL = 'level';
    const KEY_PROCESS_ID = 'process_id';
    const KEY_PROCESS_PATH = 'process_path';
    const KEY_MESSAGE = 'message';
    const KEY_CONTEXT = 'context';

    protected $time;
    protected $level;
    protected $process_id;
    protected $process_path;
    protected $message;
    protected $context;

    public function jsonSerialize(): array
    {
        return [
            self::KEY_TIME => $this->getTime(),
            self::KEY_LEVEL => $this->getLevel(),
            self::KEY_PROCESS_ID => $this->getProcessId(),
            self::KEY_PROCESS_PATH => $this->getProcessPath(),
            self::KEY_MESSAGE => $this->getMessage(),
            self::KEY_CONTEXT => $this->getContext(),
        ];
    }

    public function getTime(): string
    {
        if ($this->time === null) {
            throw new \LogicException('Message ' . self::KEY_TIME . ' has not been set.');
        }

        return $this->time;
    }

    public function setTime(string $time): MessageInterface
    {
        if ($this->time !== null) {
            throw new \LogicException('Message ' . self::KEY_TIME . ' already set.');
        }

        $this->time = $time;

        return $this;
    }

    public function getLevel(): string
    {
        if ($this->level === null) {
            throw new \LogicException('Message ' . self::KEY_LEVEL . ' has not been set.');
        }

        return $this->level;
    }

    public function setLevel(string $level): MessageInterface
    {
        if ($this->level !== null) {
            throw new \LogicException('Message ' . self::KEY_LEVEL . ' already set.');
        }

        $this->level = $level;

        return $this;
    }

    public function getProcessId(): string
    {
        if ($this->process_id === null) {
            throw new \LogicException('Message ' . self::KEY_PROCESS_ID . ' has not been set.');
        }

        return $this->process_id;
    }

    public function setProcessId(string $process_id): MessageInterface
    {
        if ($this->process_id !== null) {
            throw new \LogicException('Message ' . self::KEY_PROCESS_ID . ' already set.');
        }

        $this->process_id = $process_id;

        return $this;
    }

    public function getProcessPath(): string
    {
        if ($this->process_path === null) {
            throw new \LogicException('Message ' . self::KEY_PROCESS_PATH . ' has not been set.');
        }

        return $this->process_path;
    }

    public function setProcessPath(string $process_path): MessageInterface
    {
        if ($this->process_path !== null) {
            throw new \LogicException('Message ' . self::KEY_PROCESS_PATH . ' already set.');
        }

        $this->process_path = $process_path;

        return $this;
    }

    public function getMessage(): string
    {
        if ($this->message === null) {
            throw new \LogicException('Message ' . self::KEY_MESSAGE . ' has not been set.');
        }

        return $this->message;
    }

    public function setMessage(string $message): MessageInterface
    {
        if ($this->message !== null) {
            throw new \LogicException('Message ' . self::KEY_MESSAGE . ' already set.');
        }

        $this->message = $message;

        return $this;
    }

    public function getContext(): \JsonSerializable
    {
        if ($this->context === null) {
            throw new \LogicException('Message context has not been set.');
        }

        return $this->context;
    }

    public function setContext(\JsonSerializable $context): MessageInterface
    {
        if ($this->context !== null) {
            throw new \LogicException('Message context is already set.');
        }

        $this->context = $context;

        return $this;
    }
}
