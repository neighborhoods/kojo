<?php
declare(strict_types=1);


namespace Neighborhoods\Kojo\Process\Pool;

class LogFormatter implements LogFormatterInterface
{
    /** @var array */
    protected $messageParts;

    /** @var string */
    protected $formattedMessage;

    public function formatPipes()
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

        $message = implode(' | ', array_values($messageParts));
        $this->setFormattedMessage($message);
    }

    public function formatJson()
    {
        $message = json_encode($this->getMessageParts());
        $this->setFormattedMessage($message);
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

    public function getFormattedMessage() : string
    {
        if ($this->formattedMessage === null) {
            throw new \LogicException('LogFormatter formattedMessage has not been set.');
        }

        return $this->formattedMessage;
    }

    public function setFormattedMessage(string $formattedMessage) : LogFormatterInterface
    {
        $this->formattedMessage = $formattedMessage;

        return $this;
    }

}
