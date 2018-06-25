<?php


namespace Neighborhoods\Kojo\Process;


interface LogFormatterInterface
{

    public function writePipes();

    public function getMessageParts() : array;

    public function setMessageParts(array $messageParts) : LogFormatterInterface;
}
