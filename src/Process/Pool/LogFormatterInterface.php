<?php


namespace Neighborhoods\Kojo\Process\Pool;


interface LogFormatterInterface
{

    public function format() : LogFormatterInterface;

    public function formatPipes() : LogFormatterInterface;

    public function formatJson() : LogFormatterInterface;

    public function getMessageParts() : array;

    public function setMessageParts(array $messageParts) : LogFormatterInterface;

    public function getFormattedMessage() : string;

    public function setFormattedMessage(string $formattedMessage) : LogFormatterInterface;

    public function setProcessPathPadding(int $processPathPadding) : LogFormatterInterface;

    public function setProcessIdPadding(int $processIdPadding) : LogFormatterInterface;

    public function setLogFormat(string $logFormat);
}
