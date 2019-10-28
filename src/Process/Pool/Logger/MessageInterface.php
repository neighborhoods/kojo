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
}
