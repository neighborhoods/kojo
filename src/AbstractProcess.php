<?php

namespace NHDS\Jobs;

use NHDS\Jobs\Process\Pool;
use NHDS\Jobs\Message\Broker;
use NHDS\Jobs\Process\Pool\Logger;
use NHDS\Toolkit\Data\Property\Strict;

abstract class AbstractProcess implements ProcessInterface
{
    use Pool\AwareTrait;
    use Strict\AwareTrait;
    use Logger\AwareTrait;
    use Broker\Type\Collection\AwareTrait;
    const PROP_TYPE_CODE = 'type_code';
    protected $_processId;
    protected $_parentProcessId;
    protected $_throttle;
    protected $_exitCode;
    protected $_messageBroker;

    protected function _init(int $processId = null): AbstractProcess
    {
        if ($processId === null) {
            $this->_setParentProcessId(posix_getppid());
            $this->_setProcessId(posix_getpid());
            $this->_getLogger()->setProcess($this);
        }else {
            $this->_setProcessId($processId);
        }

        return $this;
    }

    public function getTypeCode(): string
    {
        return $this->_read(self::PROP_TYPE_CODE);
    }

    public function setTypeCode(string $typeCode): ProcessInterface
    {
        $this->_create(self::PROP_TYPE_CODE, $typeCode);

        return $this;
    }

    public function fork(int $parentProcessId): ProcessInterface
    {
        $processId = pcntl_fork();
        if ($processId === -1) {
            throw new \Exception('Failed to fork new Process.');
        }elseif ($processId > 0) {
            // This is executed in the ProcessPool.
            $this->_init($processId);
            $this->_getLogger()->debug("Forked Process[{$this->getProcessId()}][{$this->getTypeCode()}].");
        }else {
            // This is executed in the Process.
            $this->_init();
            $this->_getPool()->resetPool();
            $this->_getLogger()->debug("Running Process...");
            $this->_run();
            $this->_getLogger()->debug("Process finished running.");
            $this->_exit(0);
        }

        return $this;
    }

    abstract protected function _run(): AbstractProcess;

    public function setThrottle(int $seconds = 0): ProcessInterface
    {
        if ($this->_throttle === null) {
            $this->_throttle = $seconds;
        }else {
            throw new \LogicException('Throttle is already set.');
        }

        return $this;
    }

    protected function _setProcessId(int $processId): AbstractProcess
    {
        if ($this->_processId === null) {
            $this->_processId = $processId;
        }else {
            throw new \Exception('Process ID is already set.');
        }

        return $this;
    }

    public function getProcessId(): int
    {
        if ($this->_processId === null) {
            throw new \LogicException('Process ID is not set.');
        }

        return $this->_processId;
    }

    protected function _setParentProcessId(int $parentProcessId): AbstractProcess
    {
        if ($this->_parentProcessId === null) {
            $this->_parentProcessId = $parentProcessId;
        }else {
            throw new \LogicException('Parent process ID is already set.');
        }

        return $this;
    }

    public function getParentProcessId(): int
    {
        if ($this->_parentProcessId === null) {
            throw new \LogicException('Parent process ID is not set.');
        }

        return $this->_parentProcessId;
    }

    public function setExitCode(int $exitCode): ProcessInterface
    {
        if ($this->_exitCode === null) {
            $this->_exitCode = $exitCode;
        }else {
            throw new \LogicException('Exit code is already set.');
        }

        return $this;
    }

    public function getExitCode(): int
    {
        if ($this->_exitCode === null) {
            throw new \LogicException('Exit code is not set.');
        }

        return $this->_exitCode;
    }

    protected function _exit(int $exitCode)
    {
        $this->_getLogger()->debug("Exiting Process.");
        exit($exitCode);
    }
}