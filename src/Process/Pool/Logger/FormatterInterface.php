<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger;


interface FormatterInterface
{

    public function format() : FormatterInterface;

    public function formatPipes() : FormatterInterface;

    public function formatJson() : FormatterInterface;

    public function getMessageParts() : array;

    public function setMessageParts(array $messageParts) : FormatterInterface;

    public function getFormattedMessage() : string;

    public function setFormattedMessage(string $formattedMessage) : FormatterInterface;

    public function setProcessPathPadding(int $processPathPadding) : FormatterInterface;

    public function setProcessIdPadding(int $processIdPadding) : FormatterInterface;

    public function setLogFormat(string $logFormat);
}
