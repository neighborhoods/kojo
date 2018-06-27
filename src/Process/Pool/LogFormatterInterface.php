<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;


interface LogFormatterInterface
{
    public function setMessageParts(array $messageParts) : LogFormatterInterface;

    public function getFormattedMessage() : string;

    public function setProcessPathPadding(int $processPathPadding) : LogFormatterInterface;

    public function setProcessIdPadding(int $processIdPadding) : LogFormatterInterface;

    public function setLogFormat(string $logFormat);
}
