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

    const LOG_FORMAT_PIPES = 'pipes';
    const LOG_FORMAT_JSON = 'json';

    public function getFormattedMessage(MessageInterface $message) : string
    {
        if ($this->hasLogFormat() && $this->getLogFormat() === self::LOG_FORMAT_PIPES) {
            return $this->formatPipes($message);
        } else {
            return $this->formatJson($message);
        }
    }

    public function getFormattedThrowableMessage(\Throwable $throwable): string
    {
        $throwableType = get_class($throwable);
        $throwableMessage = $throwable->getMessage();
        return "{$throwableType}: {$throwableMessage}";
    }

    protected function formatPipes(MessageInterface $message) : string
    {
        $processIdPaddingLength = $this->getProcessIdPadding();
        $processPathPaddingLength = $this->getProcessPathPadding();

        $processID = str_pad($message->getProcessId(), $processIdPaddingLength, ' ', STR_PAD_LEFT);
        $processPath = str_pad($message->getProcessPath(), $processPathPaddingLength, ' ');
        $level = str_pad($message->getLevel(), 12, ' ');

        return implode(' | ', [$message->getTime(), $level, $processID, $processPath, $message->getMessage()]);
    }

    protected function formatJson(MessageInterface $message) : string
    {
        return json_encode($message);
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
