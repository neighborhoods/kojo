<?php
declare(strict_types=1);


namespace Neighborhoods\Kojo\Process\Pool\Logger;

use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcessInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\Message\MetadataInterface;

class Message implements MessageInterface, \JsonSerializable
{
    const KEY_TIME = 'time';
    const KEY_LEVEL = 'level';
    const KEY_PROCESS_ID = 'process_id';
    const KEY_PROCESS_PATH = 'process_path';
    const KEY_MESSAGE = 'message';

    protected $time;
    protected $level;
    protected $message;
    protected $context;
    protected $context_json_last_error;
    /** @var MetadataInterface */
    protected $kojo_metadata;

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
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

    public function setContext(array $context): MessageInterface
    {
        if ($this->context !== null) {
            throw new \LogicException('Message context is already set.');
        }

        $this->context = $context;

        return $this;
    }

    public function getContext(): array
    {
        if ($this->context === null) {
            throw new \LogicException('Message context has not been set.');
        }

        return $this->context;
    }

    public function getContextJsonLastError(): int
    {
        if ($this->context_json_last_error === null) {
            throw new \LogicException('Message context_json_last_error has not been set.');
        }

        return $this->context_json_last_error;
    }

    public function setContextJsonLastError(int $context_json_last_error): MessageInterface
    {
        if ($this->context_json_last_error !== null) {
            throw new \LogicException('Message context_json_last_error is already set.');
        }

        $this->context_json_last_error = $context_json_last_error;

        return $this;
    }

    public function getMetadata() : MetadataInterface
    {
        if ($this->kojo_metadata === null) {
            throw new \LogicException('Message kojo_metadata has not been set.');
        }

        return $this->kojo_metadata;
    }

    public function setMetadata(MetadataInterface $kojo_metadata) : MessageInterface
    {
        if ($this->kojo_metadata !== null) {
            throw new \LogicException('Message kojo_metadata is already set.');
        }

        $this->kojo_metadata = $kojo_metadata;

        return $this;
    }
}
