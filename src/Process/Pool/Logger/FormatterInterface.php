<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger;


interface FormatterInterface
{
    public function getFormattedMessage(MessageInterface $message): string;

    public function setProcessPathPadding(int $processPathPadding): FormatterInterface;

    public function setProcessIdPadding(int $processIdPadding): FormatterInterface;

    public function setLogFormat(string $logFormat);

    /**
     * @deprecated Use the \Throwable's __toString() method (or cast as a string) as the message and/or context instead.
     */
    public function getFormattedThrowableMessage(\Throwable $throwable): string;
}
