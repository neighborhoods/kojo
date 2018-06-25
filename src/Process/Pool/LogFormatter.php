<?php
declare(strict_types=1);


namespace Neighborhoods\Kojo\Process\Pool;

class LogFormatter implements LogFormatterInterface
{
    /** @var array */
    protected $messageParts;

    public function writePipes()
    {
        $messageParts = [
            'time' => $this->getMessageParts()['time'],
            'level' => $this->getMessageParts()['level'],
            'processId' => $this->getMessageParts()['processId'],
            'typeCode' => $this->getMessageParts()['typeCode'],
            'message' => $this->getMessageParts()['message'],
        ];

        $processIdPadding = 6;
        $processPathPadding = 80;

        $messageParts['processId'] = str_pad($messageParts['processId'], $processIdPadding, ' ', STR_PAD_LEFT);
        $messageParts['typeCode'] = str_pad($messageParts['typeCode'], $processPathPadding, ' ');
        $messageParts['level'] = str_pad($messageParts['level'], 12, ' ');

        $message = implode(' | ', array_values($this->getMessageParts()));
        $this->write($message);
    }

    public function writeJson()
    {
        $message = json_encode($this->getMessageParts());
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
