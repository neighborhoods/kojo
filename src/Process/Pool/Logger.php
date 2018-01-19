<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Pool;

use Psr\Log;
use NHDS\Toolkit\Time;
use NHDS\Jobs\ProcessInterface;
use NHDS\Toolkit\Data\Property\Strict;

class Logger extends Log\AbstractLogger implements LoggerInterface
{
    use Time\AwareTrait;
    use Strict\AwareTrait;
    const PAD_PID         = 6;
    const PAD_PATH        = 50;
    const PROP_IS_ENABLED = 'is_enabled';

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
            if ($this->_exists(ProcessInterface::class)) {
                $processId = str_pad((string)$this->_getProcess()->getProcessId(), self::PAD_PID, ' ', STR_PAD_LEFT);
                $typeCode = str_pad($this->_getProcess()->getPath(), self::PAD_PATH, ' ');
            }else {
                $processId = str_pad('', self::PAD_PID, '?', STR_PAD_LEFT);
                $typeCode = str_pad('', self::PAD_PATH, '?');
            }

            $level = str_pad($level, 12, ' ');
            $referenceTime = $this->_getTime()->getUnixReferenceTimeNow();
            $format = "%s | %s | %s | %s | %s\n";
            fwrite(STDOUT, sprintf($format, $referenceTime, $level, $processId, $typeCode, $message));
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
}