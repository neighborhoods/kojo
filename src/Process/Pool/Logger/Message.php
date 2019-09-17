<?php
declare(strict_types=1);


namespace Neighborhoods\Kojo\Process\Pool\Logger;

use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\Message\ProcessInterface;

class Message implements MessageInterface, \JsonSerializable
{
    const KEY_TIME = 'time';
    const KEY_LEVEL = 'level';
    const KEY_PROCESS_ID = 'process_id';
    const KEY_PROCESS_PATH = 'process_path';
    const KEY_MESSAGE = 'message';

    protected $time;
    protected $level;
    protected $process_id;
    protected $process_path;
    protected $kojo_job;
    /** @var SerializableProcessInterface */
    protected $kojo_process;
    protected $message;
    protected $context;
    protected $context_json_last_error;

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

    public function hasKojoJob(): bool
    {
        return isset($this->kojo_job);
    }

    public function getKojoJob() : JobInterface
    {
        if ($this->kojo_job === null) {
            throw new \LogicException('Message kojo_job has not been set.');
        }

        return $this->kojo_job;
    }

    public function setKojoJob(JobInterface $kojo_job) : MessageInterface
    {
        if ($this->kojo_job !== null) {
            throw new \LogicException('Message kojo_job is already set.');
        }

        $this->kojo_job = $kojo_job;

        return $this;
    }

    public function hasKojoProcess() : bool
    {
        return isset($this->kojo_process);
    }

    public function getKojoProcess() : SerializableProcessInterface
    {
        if ($this->kojo_process === null) {
            throw new \LogicException('Message kojo_process has not been set.');
        }

        return $this->kojo_process;
    }

    public function setKojoProcess(SerializableProcessInterface $kojo_process) : MessageInterface
    {
        if ($this->kojo_process !== null) {
            throw new \LogicException('Message kojo_process is already set.');
        }

        $this->kojo_process = $kojo_process;

        return $this;
    }
}
