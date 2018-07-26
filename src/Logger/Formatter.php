<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Logger;

class Formatter implements FormatterInterface
{
    public const PAD_PID = 6;
    public const PAD_PATH = 50;
    public const PROP_PROCESS_PATH_PADDING = 'process_path_padding';
    public const PROP_PROCESS_ID_PADDING = 'process_id_padding';
    public const PROP_LOG_FORMAT = 'log_format';
    public const LOG_FORMAT_PIPES = 'pipes';
    public const LOG_FORMAT_JSON = 'json';

    /** @var int */
    protected $processPathPadding;
    /** @var int */
    protected $processIdPadding;
    /** @var string */
    protected $logFormat;

    public function getFormattedMessage(MessageInterface $message): string
    {
        if ($this->hasLogFormat() && $this->getLogFormat() === self::LOG_FORMAT_PIPES) {
            return $this->formatPipes($message);
        } else {
            return $this->formatJson($message);
        }
    }

    protected function formatPipes(MessageInterface $message): string
    {
        $processIdPaddingLength = $this->getProcessIdPadding();
        $processPathPaddingLength = $this->getProcessPathPadding();

        $processID = str_pad($message->getProcessId(), $processIdPaddingLength, ' ', STR_PAD_LEFT);
        $processPath = str_pad($message->getProcessPath(), $processPathPaddingLength, ' ');
        $level = str_pad($message->getLevel(), 12, ' ');

        return implode(' | ', [$message->getTime(), $level, $processID, $processPath, $message->getMessage()]);
    }

    protected function formatJson(MessageInterface $message): string
    {
        return json_encode($message);
    }

    public function getProcessPathPadding(): int
    {
        if ($this->processPathPadding === null) {
            throw new \LogicException('Formatter processPathPadding has not been set.');
        }

        return $this->processPathPadding;
    }

    public function setProcessPathPadding(int $processPathPadding): FormatterInterface
    {
        if ($this->processPathPadding !== null) {
            throw new \LogicException('Formatter processPathPadding is already set.');
        }
        $this->processPathPadding = $processPathPadding;

        return $this;
    }

    public function getProcessIdPadding(): int
    {
        if ($this->processIdPadding === null) {
            throw new \LogicException('Formatter processIdPadding has not been set.');
        }

        return $this->processIdPadding;
    }

    public function setProcessIdPadding(int $processIdPadding): FormatterInterface
    {
        if ($this->processIdPadding !== null) {
            throw new \LogicException('Formatter processIdPadding is already set.');
        }
        $this->processIdPadding = $processIdPadding;

        return $this;
    }

    public function getLogFormat(): string
    {
        if (!$this->hasLogFormat()) {
            throw new \LogicException('Formatter logFormat has not been set.');
        }

        return $this->logFormat;
    }

    public function setLogFormat(string $logFormat): FormatterInterface
    {
        if ($this->hasLogFormat()) {
            throw new \LogicException('Formatter logFormat is already set.');
        }
        $this->logFormat = $logFormat;

        return $this;
    }

    protected function hasLogFormat(): bool
    {
        return $this->logFormat === null ? false : true;
    }
}
