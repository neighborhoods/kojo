<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\Process\Pool\Logger;
use Neighborhoods\Kojo\Process\Signal\HandlerInterface;
use Neighborhoods\Kojo\Process\Signal\InformationInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;

abstract class ProcessAbstract implements ProcessInterface
{
    use Process\Pool\Factory\AwareTrait;
    use Process\Registry\AwareTrait;
    use Process\Pool\AwareTrait;
    use Process\Strategy\AwareTrait;
    use Process\Signal\AwareTrait;
    use Defensive\AwareTrait;
    use Logger\AwareTrait;
    protected $_exitCode = 0;

    protected function _initialize(): ProcessAbstract
    {
        $this->_getProcessSignal()->incrementWaitCount();
        $this->_setParentProcessId(posix_getppid());
        $this->_setProcessId(posix_getpid());

        $this->_getLogger()->setProcess($this);
        if ($this->_hasProcessPool()) {
            $this->_getProcessPool()->emptyChildProcesses();
            $this->_getProcessPool()->getProcess()->unregisterShutdownMethod();
            $this->_unsetProcessPool();
        }
        $this->setProcessPool($this->_getProcessPoolFactory()->create());
        $this->_getProcessPool()->setProcess($this);
        $this->_registerSignalHandlers();
        $this->_registerShutdownMethod();
        $this->_getProcessRegistry()->pushProcess($this);
        $this->_setProcessTitle();
        $this->_getProcessSignal()->decrementWaitCount();

        return $this;
    }

    protected function _registerSignalHandlers(): ProcessInterface
    {
        $this->_getProcessSignal()->addSignalHandler(SIGCHLD, $this->_getProcessPool());
        $this->_getProcessSignal()->addSignalHandler(SIGALRM, $this->_getProcessPool());
        $this->_getProcessSignal()->addSignalHandler(SIGTERM, $this);
        $this->_getProcessSignal()->addSignalHandler(SIGINT, $this);
        $this->_getProcessSignal()->addSignalHandler(SIGHUP, $this);
        $this->_getProcessSignal()->addSignalHandler(SIGQUIT, $this);
        $this->_getProcessSignal()->addSignalHandler(SIGABRT, $this);

        return $this;
    }

    protected function _setProcessTitle(): ProcessInterface
    {
        $this->_create(self::PROP_IS_PROCESS_TITLE_SET, true);
        cli_set_process_title($this->_getTitlePrefix() . $this->getPath());

        return $this;
    }

    public function setTitlePrefix(string $titlePrefix): ProcessInterface
    {
        $this->_create(self::PROP_TITLE_PREFIX, $titlePrefix);

        return $this;
    }

    protected function _getTitlePrefix(): string
    {
        return $this->_read(self::PROP_TITLE_PREFIX);
    }

    public function handleSignal(InformationInterface $information): HandlerInterface
    {
        $this->_getProcessSignal()->block();
        $this->exit();

        return $this;
    }

    protected function _setOrReplaceExitCode(int $exitCode): ProcessInterface
    {
        $this->_exitCode = $exitCode;

        return $this;
    }

    public function exit(): void
    {
        $this->_getProcessSignal()->block();
        $this->unregisterShutdownMethod();
        $this->_getProcessPool()->terminateChildProcesses();
        exit($this->_exitCode);
    }

    public function shutdown(): ProcessInterface
    {
        if ($this->_read(self::PROP_IS_SHUTDOWN_METHOD_ACTIVE)) {
            $this->_getLogger()->critical("Shutdown method invoked.");
            $this->_setOrReplaceExitCode(255);
            $this->exit();
        }

        return $this;
    }

    protected function _registerShutdownMethod(): ProcessInterface
    {
        $this->_create(self::PROP_IS_SHUTDOWN_METHOD_ACTIVE, true);
        register_shutdown_function([$this, 'shutdown']);

        return $this;
    }

    public function unregisterShutdownMethod(): ProcessInterface
    {
        $this->_update(self::PROP_IS_SHUTDOWN_METHOD_ACTIVE, false);

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
}