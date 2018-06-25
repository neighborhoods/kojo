<?php
declare(strict_types=1);


namespace Neighborhoods\Kojo\Process\Pool;

class LogFormatter implements LogFormatterInterface
{
    /** @var array */
    protected $messageParts;

    public function writePipes()
    {
        $message = implode(' | ', array_values($this->getMessageParts()));
        $this->write($message);
    }

    public function writeJson()
    {
        $message =  json_encode($this->getMessageParts());
        $this->write($message);
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

    /**
     * @param $message
     */
    protected function write($message) : void
    {
        fwrite(STDOUT, $message . "\n");
    }

}
