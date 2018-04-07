<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Psr\Log;
use Neighborhoods\Pylon\Time;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Psr\Log\LogLevel;

class Logger extends Log\AbstractLogger implements LoggerInterface
{
    use Time\AwareTrait;
    use Defensive\AwareTrait;
    const PAD_PID                   = 6;
    const PAD_PATH                  = 50;
    const PROP_IS_ENABLED           = 'is_enabled';
    const PROP_PROCESS_PATH_PADDING = 'process_path_padding';
    const PROP_PROCESS_ID_PADDING   = 'process_id_padding';

    public function setProcess(ProcessInterface $process): LoggerInterface
    {
        $this->_createOrUpdate(ProcessInterface::class, $process);

        return $this;
    }

    protected function _getProcess(): ProcessInterface
    {
        return $this->_read(ProcessInterface::class);
    }

    public function log($level, $message, array $context = [])
    {
        if ($this->_isEnabled() === true) {
            $processIdPadding = $this->_getProcessIdPadding();
            $processPathPadding = $this->_getProcessPathPadding();
            if ($this->_exists(ProcessInterface::class)) {
                $processId = (string)$this->_getProcess()->getProcessId();
                $paddedProcessId = str_pad($processId, $processIdPadding, ' ', STR_PAD_LEFT);
                $typeCode = str_pad($this->_getProcess()->getPath(), $processPathPadding, ' ');
            }else {
                $paddedProcessId = str_pad('', $processIdPadding, '?', STR_PAD_LEFT);
                $typeCode = str_pad('', $processPathPadding, '?');
            }

            $level = str_pad($level, 12, ' ');
            $referenceTime = $this->_getTime()->getUnixReferenceTimeNow();
            $format = "%s | %s | %s | %s | %s\n";
            fwrite(STDOUT, sprintf($format, $referenceTime, $level, $paddedProcessId, $typeCode, $message));
        }

        return;
    }

    protected function _isEnabled(): bool
    {
        return $this->_read(self::PROP_IS_ENABLED);
    }

    public function setIsEnabled(bool $isEnabled): LoggerInterface
    {
        $this->_create(self::PROP_IS_ENABLED, $isEnabled);

        return $this;
    }

    public function setProcessPathPadding(int $processPathPadding): LoggerInterface
    {
        $this->_create(self::PROP_PROCESS_PATH_PADDING, $processPathPadding);

        return $this;
    }

    protected function _getProcessPathPadding(): int
    {
        return $this->_read(self::PROP_PROCESS_PATH_PADDING);
    }

    public function setProcessIdPadding(int $processIdPadding): LoggerInterface
    {
        $this->_create(self::PROP_PROCESS_ID_PADDING, $processIdPadding);

        return $this;
    }

    protected function _getProcessIdPadding(): int
    {
        return $this->_read(self::PROP_PROCESS_ID_PADDING);
    }
}