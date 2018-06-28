<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger;

use Neighborhoods\Pylon\Data\Property\Defensive;

class Formatter implements FormatterInterface
{
    use Defensive\AwareTrait;

    const PAD_PID = 6;
    const PAD_PATH = 50;
    const PROP_PROCESS_PATH_PADDING = 'process_path_padding';
    const PROP_PROCESS_ID_PADDING = 'process_id_padding';
    const PROP_LOG_FORMAT = 'log_format';

    const KEY_TIME = 'time';
    const KEY_LEVEL = 'level';
    const KEY_PROCESS_ID = 'processId';
    const KEY_TYPE_CODE = 'typeCode';
    const KEY_MESSAGE = 'message';

    const LOG_FORMAT_PIPES = 'pipes';
    const LOG_FORMAT_JSON = 'json';

    protected $message;
    protected $formattedMessage;

    public function format() : FormatterInterface
    {
        if ($this->hasLogFormat() && $this->getLogFormat() === self::LOG_FORMAT_PIPES) {
            $this->formatPipes();
        } else {
            $this->formatJson();
        }

        return $this;
    }

    public function formatPipes() : FormatterInterface
    {
        $logMessage = $this->getMessage();

        $processIdPaddingLength = $this->getProcessIdPadding();
        $processPathPaddingLength = $this->getProcessPathPadding();

        $processID = str_pad($logMessage->getProcessId(), $processIdPaddingLength, ' ', STR_PAD_LEFT);
        $typeCode = str_pad($logMessage->getTypeCode(), $processPathPaddingLength, ' ');
        $level = str_pad($logMessage->getLevel(), 12, ' ');

        $pipeDelimitedMessage = implode(' | ', [$logMessage->getTime(), $level, $processID, $typeCode, $logMessage->getMessage()]);
        $this->setFormattedMessage($pipeDelimitedMessage);

        return $this;
    }

    public function formatJson() : FormatterInterface
    {
        $logMessage = json_encode($this->getMessage());
        $this->setFormattedMessage($logMessage);

        return $this;
    }

    public function getMessage() : MessageInterface
    {
        if ($this->message === null) {
            throw new \LogicException('Formatter messageParts has not been set.');
        }

        return $this->message;
    }

    public function setMessage(MessageInterface $message) : FormatterInterface
    {
        $this->message = $message;

        return $this;
    }

    public function getFormattedMessage() : string
    {
        if ($this->formattedMessage === null) {
            throw new \LogicException('Formatter formattedMessage has not been set.');
        }

        return $this->formattedMessage;
    }

    public function setFormattedMessage(string $formattedMessage) : FormatterInterface
    {
        $this->formattedMessage = $formattedMessage;

        return $this;
    }

    public function setProcessPathPadding(int $processPathPadding) : FormatterInterface
    {
        $this->_create(self::PROP_PROCESS_PATH_PADDING, $processPathPadding);

        return $this;
    }

    protected function getProcessPathPadding() : int
    {
        return $this->_read(self::PROP_PROCESS_PATH_PADDING);
    }

    public function setProcessIdPadding(int $processIdPadding) : FormatterInterface
    {
        $this->_create(self::PROP_PROCESS_ID_PADDING, $processIdPadding);

        return $this;
    }

    protected function getProcessIdPadding() : int
    {
        return $this->_read(self::PROP_PROCESS_ID_PADDING);
    }

    public function setLogFormat(string $logFormat)
    {
        $this->_create(self::PROP_LOG_FORMAT, $logFormat);

        return $this;
    }

    protected function getLogFormat() : string
    {
        return $this->_read(self::PROP_LOG_FORMAT);
    }

    protected function hasLogFormat() : bool
    {
        return $this->_exists(self::PROP_LOG_FORMAT);
    }
}
