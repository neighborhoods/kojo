<?php

namespace NHDS\Jobs\Process\Pool;

use Psr\Log;
use NHDS\Toolkit\Time;
use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Jobs\Process\Pool;

abstract class AbstractLogger extends Log\AbstractLogger implements LoggerInterface
{
    use Time\AwareTrait;
    use Crud\AwareTrait;
    use Pool\AwareTrait;
    protected $_isEnabled;
    protected $_processId;
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

    public function setProcessId(int $processId): LoggerInterface
    {
        if ($this->_processId === null) {
            $this->_processId = $processId;
        }else {
            throw new \LogicException('Process ID is already set.');
        }

        return $this;
    }

    public function log($level, $message, array $context = [])
    {
        if ($this->_isEnabled === true) {
            if ($this->_processId === null) {
                $indicator = "< pool    ";
                $processId = $this->_getProcessPoolProcessId();
            }else {
                $indicator = "> process ";
                $processId = $this->_processId;
            }

            $paddedLevel = str_pad('[' . $level . ']', 12, ' ');
            $format = "{$indicator}[%s] - " . $this->_getTime()->getUnixReferenceTimeNow() . $paddedLevel . ": %s\n";
            fwrite(STDOUT, sprintf($format, $processId, $message));
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