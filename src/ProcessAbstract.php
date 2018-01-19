<?php
declare(strict_types=1);

namespace NHDS\Jobs;

use NHDS\Jobs\Process;
use NHDS\Jobs\Process\Pool\Logger;
use NHDS\Toolkit\Data\Property\Strict;

abstract class ProcessAbstract implements ProcessInterface
{
    use Process\Pool\AwareTrait;
    use Process\Strategy\AwareTrait;
    use Strict\AwareTrait;
    use Logger\AwareTrait;
    const PROP_TYPE_CODE           = 'type_code';
    const PROP_THROTTLE            = 'throttle';
    const PROP_PROCESS_ID          = 'process_id';
    const PROP_PARENT_PROCESS_ID   = 'parent_process_id';
    const PROP_EXIT_CODE           = 'exit_code';
    const PROP_PATH                = 'path';
    const PROP_PARENT_PROCESS_PATH = 'parent_process_path';

    protected function _initialize(int $processId = null): ProcessAbstract
    {
        if ($processId === null) {
            $this->_setParentProcessId(posix_getppid());
            $this->_setProcessId(posix_getpid());
            $this->_getLogger()->setProcess($this);
            $this->_registerSignalHandlers();
            cli_set_process_title($this->getPath());
        }else {
            $this->_setProcessId($processId);
        }

        return $this;
    }

    protected function _registerSignalHandlers(): ProcessInterface
    {
        pcntl_signal(SIGTERM, [$this, 'receivedSignal']);
        pcntl_signal(SIGINT, [$this, 'receivedSignal']);

        return $this;
    }

    public function setParentProcessPath(string $parentProcessPath): ProcessInterface
    {
        $this->_create(self::PROP_PARENT_PROCESS_PATH, $parentProcessPath);

        return $this;
    }

    protected function _getParentProcessPath(): string
    {
        return $this->_read(self::PROP_PARENT_PROCESS_PATH);
    }

    public function getPath(): string
    {
        if (!$this->_exists(self::PROP_PATH)) {
            $processId = $this->getProcessId();
            $typeCode = $this->getTypeCode();
            $path = $this->_getParentProcessPath() . '/' . $typeCode . '[' . $processId . ']';
            $this->_create(self::PROP_PATH, $path);
        }

        return $this->_read(self::PROP_PATH);
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

    abstract public function start(): ProcessInterface;

    public function setThrottle(int $seconds = 0): ProcessInterface
    {
        $this->_create(self::PROP_THROTTLE, $seconds);

        return $this;
    }

    protected function _setProcessId(int $processId): ProcessAbstract
    {
        $this->_create(self::PROP_PROCESS_ID, $processId);

        return $this;
    }

    public function getProcessId(): int
    {
        return $this->_read(self::PROP_PROCESS_ID);
    }

    protected function _setParentProcessId(int $parentProcessId): ProcessAbstract
    {
        $this->_create(self::PROP_PARENT_PROCESS_ID, $parentProcessId);

        return $this;
    }

    public function getParentProcessId(): int
    {
        return $this->_read(self::PROP_PARENT_PROCESS_ID);
    }

    public function setExitCode(int $exitCode): ProcessInterface
    {
        $this->_create(self::PROP_EXIT_CODE, $exitCode);

        return $this;
    }

    public function getExitCode(): int
    {
        return $this->_read(self::PROP_EXIT_CODE);
    }

    public function receivedSignal()
    {
        $this->_exit(0);
    }

    protected function _exit(int $exitCode)
    {
        $this->_getLogger()->debug("Exiting Process.");
        exit($exitCode);
    }
}