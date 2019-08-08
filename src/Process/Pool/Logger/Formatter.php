<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger;

use DateTime;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Formatter implements FormatterInterface
{
    use Defensive\AwareTrait;

    const PROP_PROCESS_PATH_PADDING = 'process_path_padding';
    const PROP_LOG_FORMAT = 'log_format';

    const LOG_FORMAT_PIPES = 'pipes';
    const LOG_FORMAT_JSON = 'json';
    const LOG_FORMAT_JSON_PRETTY_PRINT = 'json_pretty_print';

    public function getFormattedMessage(MessageInterface $message) : string
    {
        if ($this->hasLogFormat() && $this->getLogFormat() === self::LOG_FORMAT_PIPES) {
            return $this->formatPipes($message);
        } elseif ($this->hasLogFormat() && $this->getLogFormat() === self::LOG_FORMAT_JSON_PRETTY_PRINT) {
            return $this->formatJsonPrettyPrint($message);
        } else {
            return $this->formatJson($message);
        }
    }

    public function getFormattedThrowableMessage(\Throwable $throwable): string
    {
        if ($throwable->getPrevious()) {
            $previousType = get_class($throwable->getPrevious());
            $previousMessage = $throwable->getPrevious()->getMessage();
            $previousMessage = "{$previousType}: {$previousMessage}";
            $message = implode(' ', [$throwable->getMessage(), $previousMessage]);
        } else {
            $message = $throwable->getMessage();
        }

        return $message;
    }

    protected function formatPipes(MessageInterface $message) : string
    {
        $processPathPaddingLength = $this->getProcessPathPadding();

        $processPath = str_pad($message->getProcessPath(), $processPathPaddingLength, ' ');
        $level = str_pad($message->getLevel(), 8, ' ');
        $kojoJobTypeCode = str_pad($message->hasKojoJob() ? $message->getKojoJob()->getTypeCode() : '', 26, ' ');
        $kojoJobAssignedState = str_pad(
            $message->hasKojoJob() ? $message->getKojoJob()->getAssignedState() : '',
            20,
            ' '
        );


        return implode(
            ' | ',
            [
                DateTime::createFromFormat('D, d M y H:i:s.u T', $message->getTime())->format('H:i:s.u'),
                $level,
                $processPath,
                $kojoJobTypeCode,
                $kojoJobAssignedState,
                $message->getMessage(),
            ]
        );
    }

    protected function formatJson(MessageInterface $message) : string
    {
        return json_encode($message);
    }

    protected function formatJsonPrettyPrint(MessageInterface $message) : string
    {
        return json_encode($message, JSON_PRETTY_PRINT);
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
