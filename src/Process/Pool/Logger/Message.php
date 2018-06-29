<?php
declare(strict_types=1);


namespace Neighborhoods\Kojo\Process\Pool\Logger;

class Message implements MessageInterface, \JsonSerializable
{
    const KEY_TIME = 'time';
    const KEY_LEVEL = 'level';
    const KEY_PROCESS_ID = 'process_id';
    const KEY_TYPE_CODE = 'type_code';
    const KEY_MESSAGE = 'message';

    protected $time;
    protected $level;
    protected $process_id;
    protected $type_code;
    protected $message;

    public function jsonSerialize() : array
    {
        return [
            self::KEY_TIME => $this->getTime(),
            self::KEY_LEVEL => $this->getLevel(),
            self::KEY_PROCESS_ID => $this->getProcessId(),
            self::KEY_TYPE_CODE => $this->getTypeCode(),
            self::KEY_MESSAGE => $this->getMessage(),
        ];
    }

    public function getTime() : string
    {
        if ($this->time === null) {
            throw new \LogicException('Message ' . self::KEY_TIME . ' has not been set.');
        }

        return $this->time;
    }

    public function setTime(string $time) : MessageInterface
    {
        if ($this->time !== null) {
            throw new \LogicException('Message ' . self::KEY_TIME . ' already set.');
        }

        $this->time = $time;

        return $this;
    }

    public function getLevel() : string
    {
        if ($this->level === null) {
            throw new \LogicException('Message ' . self::KEY_LEVEL . ' has not been set.');
        }

        return $this->level;
    }

    public function setLevel(string $level) : MessageInterface
    {
        if ($this->level !== null) {
            throw new \LogicException('Message ' . self::KEY_LEVEL . ' already set.');
        }

        $this->level = $level;

        return $this;
    }

    public function getProcessId() : string
    {
        if ($this->process_id === null) {
            throw new \LogicException('Message ' . self::KEY_PROCESS_ID . ' has not been set.');
        }

        return $this->process_id;
    }

    public function setProcessId(string $process_id) : MessageInterface
    {
        if ($this->process_id !== null) {
            throw new \LogicException('Message ' . self::KEY_PROCESS_ID . ' already set.');
        }

        $this->process_id = $process_id;

        return $this;
    }

    public function getTypeCode() : string
    {
        if ($this->type_code === null) {
            throw new \LogicException('Message ' . self::KEY_TYPE_CODE . ' has not been set.');
        }

        return $this->type_code;
    }

    public function setTypeCode(string $type_code) : MessageInterface
    {
        if ($this->type_code !== null) {
            throw new \LogicException('Message ' . self::KEY_TYPE_CODE . ' already set.');
        }

        $this->type_code = $type_code;

        return $this;
    }

    public function getMessage() : string
    {
        if ($this->message === null) {
            throw new \LogicException('Message ' . self::KEY_MESSAGE . ' has not been set.');
        }

        return $this->message;
    }

    public function setMessage(string $message) : MessageInterface
    {
        if ($this->message !== null) {
            throw new \LogicException('Message ' . self::KEY_MESSAGE . ' already set.');
        }

        $this->message = $message;

        return $this;
    }
}
