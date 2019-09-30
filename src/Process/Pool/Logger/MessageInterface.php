<?php
declare(strict_types=1);


namespace Neighborhoods\Kojo\Process\Pool\Logger;

use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\Message\MetadataInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcessInterface;

interface MessageInterface
{
    public function getTime(): string;

    public function setTime(string $time): MessageInterface;

    public function getLevel(): string;

    public function setLevel(string $level): MessageInterface;

    public function getMessage(): string;

    public function setMessage(string $message): MessageInterface;

    public function setContext(array $context): MessageInterface;

    public function getContext(): array;

    public function getContextJsonLastError(): int;

    public function setContextJsonLastError(int $context_json_last_error): MessageInterface;

    public function setMetadata(MetadataInterface $kojo_metadata) : MessageInterface;

    public function getMetadata() : MetadataInterface;

    /** @param int $process_id
     * @return MessageInterface
     * @deprecated
     */
    public function setProcessId(int $process_id) : MessageInterface;

    /** @param string $process_path
     * @return MessageInterface
     * @deprecated
     */
    public function setProcessPath(string $process_path) : MessageInterface;

    /**
     * @param JobInterface $kojo_job
     * @return MessageInterface
     * @deprecated
     */
    public function setKojoJob(JobInterface $kojo_job) : MessageInterface;

    /**
     * @param SerializableProcessInterface $kojo_job
     * @return MessageInterface
     * @deprecated
     */
    public function setKojoProcess(SerializableProcessInterface $kojo_job) : MessageInterface;
}
