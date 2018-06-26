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
    const PROP_LOG_FORMAT = 'log_format';

    const KEY_TIME = 'time';
    const KEY_LEVEL = 'level';
    const KEY_PROCESS_ID = 'processId';
    const KEY_TYPE_CODE = 'typeCode';
    const KEY_MESSAGE = 'message';

    const LOG_FORMAT_PIPES = 'pipes';
    const LOG_FORMAT_JSON = 'json';

    protected $messageParts;
    protected $formattedMessage;

    public function format() : LogFormatterInterface
    {
        if ($this->hasLogFormat() && $this->getLogFormat() === self::LOG_FORMAT_PIPES) {
            $this->formatPipes();
        } else {
            $this->formatJson();
        }

        return $this;
    }

    public function formatPipes() : LogFormatterInterface
    {
        $paddedMessage = [
            self::KEY_TIME => $this->getMessageParts()[self::KEY_TIME],
            self::KEY_LEVEL => $this->getMessageParts()[self::KEY_LEVEL],
            self::KEY_PROCESS_ID => $this->getMessageParts()[self::KEY_PROCESS_ID],
            self::KEY_TYPE_CODE => $this->getMessageParts()[self::KEY_TYPE_CODE],
            self::KEY_MESSAGE => $this->getMessageParts()[self::KEY_MESSAGE],
        ];

        $processIdPadding = $this->getProcessIdPadding();
        $processPathPadding = $this->getProcessPathPadding();

        $paddedMessage[self::KEY_PROCESS_ID] = str_pad($paddedMessage[self::KEY_PROCESS_ID],
                                                       $processIdPadding,
                                                       ' ',
                                                       STR_PAD_LEFT
        );
        $paddedMessage[self::KEY_TYPE_CODE] = str_pad($paddedMessage[self::KEY_TYPE_CODE], $processPathPadding, ' ');
        $paddedMessage[self::KEY_LEVEL] = str_pad($paddedMessage[self::KEY_LEVEL], 12, ' ');

        $message = implode(' | ', array_values($paddedMessage));
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
