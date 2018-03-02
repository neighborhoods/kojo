<?php
declare(strict_types=1);

namespace NHDS\Jobs;

use NHDS\Jobs\Process;
use NHDS\Jobs\Process\Pool\Logger;
use NHDS\Toolkit\Data\Property\Strict;

abstract class ProcessAbstract implements ProcessInterface
{
    use Process\Registry\AwareTrait;
    use Process\Pool\AwareTrait;
    use Process\Strategy\AwareTrait;
    use Strict\AwareTrait;
    use Logger\AwareTrait;
    const PROP_IS_PROCESS_TITLE_SET = 'is_process_title_set';

    protected function _initialize(int $processId): ProcessAbstract
    {
        if ($processId === 0) {
            pcntl_async_signals(true);
            $this->_setParentProcessId(posix_getppid());
            $this->_setProcessId(posix_getpid());
            $this->_getLogger()->setProcess($this);
            $this->_registerSignalHandlers();
            $this->_setProcessTitle();
            $this->_getProcessRegistry()->pushProcess($this);
        }else {
            $this->_setProcessId($processId);
        }

        return $this;
    }

    abstract public function processPoolStarted(): ProcessInterface;

    protected function _setProcessTitle(): ProcessInterface
    {
        $this->_create(self::PROP_IS_PROCESS_TITLE_SET, true);
        cli_set_process_title($this->getPath());

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
        $this->_getLogger()->debug("Received signal.");
        $this->_exit(0);
    }

    public function setTerminationSignalNumber(int $terminationSignalNumber): ProcessInterface
    {
        $this->_create(self::PROP_TERMINATION_SIGNAL_NUMBER, $terminationSignalNumber);

        return $this;
    }

    public function getTerminationSignalNumber(): int
    {
        return $this->_read(self::PROP_TERMINATION_SIGNAL_NUMBER);
    }

    public function getParentProcessTerminationSignalNumber(): int
    {
        return $this->_read(self::PROP_PARENT_PROCESS_TERMINATION_SIGNAL_NUMBER);
    }

    public function setParentProcessTerminationSignalNumber(int $parentProcessTerminationSignalNumber)
    {
        $this->_create(self::PROP_PARENT_PROCESS_TERMINATION_SIGNAL_NUMBER, $parentProcessTerminationSignalNumber);

        return $this;
    }

    public function setParentProcessUuid(string $parentProcessUuid): ProcessInterface
    {
        $this->_create(self::PROP_PARENT_PROCESS_UUID, $parentProcessUuid);

        return $this;
    }

    public function getParentProcessUuid(): string
    {
        return $this->_read(self::PROP_PARENT_PROCESS_UUID);
    }

    public function getUuid(): string
    {
        if (!$this->_exists(self::PROP_UUID)) {
            $hostname = gethostname();
            $processUuid = $hostname
                . '-' . gethostbyname($hostname)
                . '-' . $this->getPath()
                . '-' . sprintf('%f', microtime(true))
                . '-' . random_int(0, $this->_getUuidMaximumInteger());
            $this->_create(self::PROP_UUID, $processUuid);
            $this->_getLogger()->debug("Generated UUID[$processUuid]");
        }

        return $this->_read(self::PROP_UUID);
    }

    public function setUuidMaximumInteger(int $uuidMaximumInteger): ProcessInterface
    {
        $this->_create(self::PROP_UUID_MAXIMUM_INTEGER, $uuidMaximumInteger);

        return $this;
    }

    protected function _getUuidMaximumInteger(): int
    {
        return $this->_read(self::PROP_UUID_MAXIMUM_INTEGER);
    }

    protected function _exit(int $exitCode)
    {
        $this->_getLogger()->debug("Exiting Process.");
        exit($exitCode);
    }
}