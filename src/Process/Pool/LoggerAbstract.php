<?php

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\ProcessInterface;
use Psr\Log;
use NHDS\Toolkit\Time;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Process\Pool;

abstract class LoggerAbstract extends Log\AbstractLogger implements LoggerInterface
{
    use Time\AwareTrait;
    use Strict\AwareTrait;
    use Pool\AwareTrait;
    const PAD_PID       = 6;
    const PAD_TYPE_CODE = 18;
    protected $_isEnabled;
    protected $_processPoolProcessId;

    public function setProcessPoolProcessId(int $processPoolProcessId): LoggerInterface
    {
        if ($this->_processPoolProcessId === null) {
            $this->_processPoolProcessId = $processPoolProcessId;
        }else {
            throw new \LogicException('ProcessPool process ID is already set.');
        }

        return $this;
    }

    protected function _getProcessPoolProcessId()
    {
        if ($this->_processPoolProcessId === null) {
            $this->_processPoolProcessId = $this->_getPool()->getProcessId();
        }

        return $this->_processPoolProcessId;
    }

    public function setProcess(ProcessInterface $process): LoggerInterface
    {
        $this->_create(ProcessInterface::class, $process);

        return $this;
    }

    protected function _getProcess(): ProcessInterface
    {
        return $this->_read(ProcessInterface::class);
    }

    public function log($level, $message, array $context = [])
    {
        if ($this->_isEnabled === true) {
            if (!$this->_exists(ProcessInterface::class)) {
                $processId = str_pad($this->_getProcessPoolProcessId(), self::PAD_PID, ' ', STR_PAD_LEFT);
                $typeCode = str_pad('pool', self::PAD_TYPE_CODE, ' ');
            }else {
                $processId = str_pad($this->_getProcess()->getProcessId(), self::PAD_PID, ' ', STR_PAD_LEFT);
                $typeCode = str_pad($this->_getProcess()->getTypeCode(), self::PAD_TYPE_CODE, ' ');
            }

            $level = str_pad($level, 12, ' ');
            $referenceTime = $this->_getTime()->getUnixReferenceTimeNow();
            $format = "%s | %s | %s | %s | %s\n";
            fwrite(STDOUT, sprintf($format, $referenceTime, $level, $processId, $typeCode, $message));
        }

        return;
    }

    public function setIsEnabled(bool $isEnabled): LoggerInterface
    {
        if ($this->_isEnabled === null) {
            $this->_isEnabled = (bool)$isEnabled;
        }else {
            throw new \LogicException('Is enabled is already set.');
        }

        return $this;
    }
}