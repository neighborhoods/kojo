<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Pylon\Time;
use Psr\Log;

class Logger extends Log\AbstractLogger implements LoggerInterface
{
    use Time\AwareTrait;
    use Defensive\AwareTrait;
    const PAD_PID = 6;
    const PAD_PATH = 50;
    const PROP_IS_ENABLED = 'is_enabled';
    const PROP_PROCESS_PATH_PADDING = 'process_path_padding';
    const PROP_PROCESS_ID_PADDING = 'process_id_padding';

    protected $log_formatter;

    public function setProcess(ProcessInterface $process) : LoggerInterface
    {
        $this->_createOrUpdate(ProcessInterface::class, $process);

        return $this;
    }

    protected function _getProcess() : ProcessInterface
    {
        return $this->_read(ProcessInterface::class);
    }

    public function log($level, $message, array $context = [])
    {
        if ($this->_isEnabled() === true) {

            if ($this->_exists(ProcessInterface::class)) {
                $processId = (string)$this->_getProcess()->getProcessId();
            } else {
                $processId = '?';
            }

            $referenceTime = $this->_getTime()->getUnixReferenceTimeNow();

            $messageParts = [
                'time' => $referenceTime,
                'level' => $level,
                'processId' => $processId,
                'typeCode' => $this->_getProcess()->getPath(),
                'message' => $message,
            ];

            $this->getLogFormatter()->setMessageParts($messageParts)->formatPipes();
            fwrite(STDOUT, $this->getLogFormatter()->getFormattedMessage() . "\n");
        }

        return;
    }

    protected function _isEnabled() : bool
    {
        return $this->_read(self::PROP_IS_ENABLED);
    }

    public function setIsEnabled(bool $isEnabled) : LoggerInterface
    {
        $this->_create(self::PROP_IS_ENABLED, $isEnabled);

        return $this;
    }

    public function setProcessPathPadding(int $processPathPadding) : LoggerInterface
    {
        $this->_create(self::PROP_PROCESS_PATH_PADDING, $processPathPadding);

        return $this;
    }

    protected function _getProcessPathPadding() : int
    {
        return $this->_read(self::PROP_PROCESS_PATH_PADDING);
    }

    public function setProcessIdPadding(int $processIdPadding) : LoggerInterface
    {
        $this->_create(self::PROP_PROCESS_ID_PADDING, $processIdPadding);

        return $this;
    }

    protected function _getProcessIdPadding() : int
    {
        return $this->_read(self::PROP_PROCESS_ID_PADDING);
    }

    public function getLogFormatter() : LogFormatterInterface
    {
        if ($this->log_formatter === null) {
            throw new \LogicException('Logger log_formatter has not been set.');
        }

        return $this->log_formatter;
    }

    public function setLogFormatter(LogFormatterInterface $log_formatter) : LoggerInterface
    {
        if ($this->log_formatter !== null) {
            throw new \LogicException('Logger log_formatter already set.');
        }

        $this->log_formatter = $log_formatter;

        return $this;
    }
}
