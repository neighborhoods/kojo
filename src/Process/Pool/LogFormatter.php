<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Pylon\Data\Property\Defensive;

class LogFormatter implements LogFormatterInterface
{
    use Defensive\AwareTrait;

    const PAD_PID = 6;
    const PAD_PATH = 50;
    const PROP_PROCESS_PATH_PADDING = 'process_path_padding';
    const PROP_PROCESS_ID_PADDING = 'process_id_padding';

    /** @var array */
    protected $messageParts;

    /** @var string */
    protected $formattedMessage;

    public function format(): LogFormatterInterface
    {
        if ((int)$this->getMessageParts()['processId'] % 2 == 0){
            $this->formatJson();
        } else {
            $this->formatPipes();
        }

        return $this;
    }

    public function formatPipes() : LogFormatterInterface
    {
        $messageParts = [
            'time' => $this->getMessageParts()['time'],
            'level' => $this->getMessageParts()['level'],
            'processId' => $this->getMessageParts()['processId'],
            'typeCode' => $this->getMessageParts()['typeCode'],
            'message' => $this->getMessageParts()['message'],
        ];

        $processIdPadding = $this->getProcessIdPadding();
        $processPathPadding = $this->getProcessPathPadding();

        $messageParts['processId'] = str_pad($messageParts['processId'], $processIdPadding, ' ', STR_PAD_LEFT);
        $messageParts['typeCode'] = str_pad($messageParts['typeCode'], $processPathPadding, ' ');
        $messageParts['level'] = str_pad($messageParts['level'], 12, ' ');

        $message = implode(' | ', array_values($messageParts));
        $this->setFormattedMessage($message);

        return $this;
    }

    public function formatJson() : LogFormatterInterface
    {
        $message = json_encode($this->getMessageParts());
        $this->setFormattedMessage($message);

        return $this;
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

    public function setProcessPathPadding(int $processPathPadding) : LogFormatterInterface
    {
        $this->_create(self::PROP_PROCESS_PATH_PADDING, $processPathPadding);

        return $this;
    }

    protected function getProcessPathPadding() : int
    {
        return $this->_read(self::PROP_PROCESS_PATH_PADDING);
    }

    public function setProcessIdPadding(int $processIdPadding) : LogFormatterInterface
    {
        $this->_create(self::PROP_PROCESS_ID_PADDING, $processIdPadding);

        return $this;
    }

    protected function getProcessIdPadding() : int
    {
        return $this->_read(self::PROP_PROCESS_ID_PADDING);
    }

}
