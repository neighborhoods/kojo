<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Logger;


interface FormatterInterface
{
    public function getFormattedMessage(MessageInterface $message) : string;

    public function setProcessPathPadding(int $processPathPadding) : FormatterInterface;

    public function setProcessIdPadding(int $processIdPadding) : FormatterInterface;

    public function setLogFormat(string $logFormat);
}
