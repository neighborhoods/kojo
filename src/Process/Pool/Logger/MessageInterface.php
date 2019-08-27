<?php
declare(strict_types=1);


namespace Neighborhoods\Kojo\Process\Pool\Logger;

use Neighborhoods\Kojo\Data\JobInterface;

interface MessageInterface
{
    public function getTime(): string;

    public function setTime(string $time): MessageInterface;

    public function getLevel(): string;

    public function setLevel(string $level): MessageInterface;

    public function getProcessId(): string;

    public function setProcessId(string $process_id): MessageInterface;

    public function getProcessPath(): string;

    public function setProcessPath(string $process_path): MessageInterface;

    public function getMessage(): string;

    public function setMessage(string $message): MessageInterface;

    public function setContext(array $context): MessageInterface;

    public function getContext(): array;

    public function getContextJsonLastError(): int;

    public function setContextJsonLastError(int $context_json_last_error): MessageInterface;

    public function getKojoJob() : JobInterface;

    public function setKojoJob(JobInterface $kojo_job) : MessageInterface;

    public function hasKojoJob() : bool;
}
