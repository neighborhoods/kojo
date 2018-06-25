<?php


namespace Neighborhoods\Kojo\Process\Pool;


interface LogFormatterInterface
{

    public function formatPipes();

    public function getMessageParts() : array;

    public function setMessageParts(array $messageParts) : LogFormatterInterface;

    public function formatJson();

    public function getFormattedMessage() : string;

    public function setFormattedMessage(string $formattedMessage) : LogFormatterInterface;
}
