<?php
declare(strict_types=1);


namespace Neighborhoods\Kojo\Process\Pool;

class LogFormatter implements LogFormatterInterface
{
    /** @var array */
    protected $messageParts;

    public function writePipes()
    {
        $message = implode(' | ', $this->getMessageParts());
        fwrite(STDOUT, $message . "\n");
    }

    public function getMessageParts() : array
    {
        if ($this->messageParts === null) {
            throw new \LogicException('LogFormatter messageParts has not been set.');
        }

        return $this->messageParts;
    }

    public function setMessageParts(array $messageParts) : LogFormatterInterface
    {
        $this->messageParts = $messageParts;

        return $this;
    }

}
