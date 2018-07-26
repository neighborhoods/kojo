<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\Process\Signal\HandlerInterface;
use Neighborhoods\Kojo\Process\Signal\InformationInterface;
use Neighborhoods\Kojo\Apm;

abstract class ProcessAbstract implements ProcessInterface
{
    use Process\Pool\Repository\AwareTrait;
    use Process\Registry\AwareTrait;
    use Process\Pool\AwareTrait;
    use Process\Strategy\AwareTrait;
    use Process\Signal\AwareTrait;
    use Logger\AwareTrait;
    use Apm\NewRelic\AwareTrait;
    protected $exitCode = 0;
    protected $isTitleSet = false;
    protected $titlePrefix;
    protected $isShutdownMethodActive = false;
    protected $parentProcessPath;
    protected $path;
    protected $throttle;
    protected $processId;
    protected $parentProcessId;
    protected $terminationSignalNumber;
    protected $parentProcessTerminationSignalNumber;
    protected $parentProcessUuid;
    protected $uuid;
    protected $uuidMaximumInteger;

    protected function initialize(): ProcessAbstract
    {
        $this->getApmNewRelic()->ignoreTransaction();
        $this->getApmNewRelic()->endTransaction();
        $this->getProcessSignal()->incrementWaitCount();
        $this->setParentProcessId(posix_getppid());
        $this->setProcessId(posix_getpid());

        $this->getLogger()->setProcess($this);
        if ($this->hasProcessPool()) {
            $this->getProcessPool()->emptyChildProcesses();
            $this->getProcessPool()->getProcess()->unregisterShutdownMethod();
            $this->unsetProcessPool();
        }
        $this->setProcessPool($this->getProcessPoolRepository()->get(static::class));
        $this->getProcessPool()->setProcess($this);
        $this->registerSignalHandlers();
        $this->registerShutdownMethod();
        $this->getProcessRegistry()->pushProcess($this);
        $this->setTitle();
        $this->getProcessSignal()->decrementWaitCount();

        return $this;
    }

    protected function registerSignalHandlers(): ProcessInterface
    {
        $this->getProcessSignal()->addSignalHandler(SIGCHLD, $this->getProcessPool());
        $this->getProcessSignal()->addSignalHandler(SIGALRM, $this->getProcessPool());
        $this->getProcessSignal()->addSignalHandler(SIGTERM, $this);
        $this->getProcessSignal()->addSignalHandler(SIGINT, $this);
        $this->getProcessSignal()->addSignalHandler(SIGHUP, $this);
        $this->getProcessSignal()->addSignalHandler(SIGQUIT, $this);
        $this->getProcessSignal()->addSignalHandler(SIGABRT, $this);
        $this->getProcessSignal()->addSignalHandler(SIGUSR1, $this);

        return $this;
    }

    protected function setTitle(): ProcessInterface
    {
        if ($this->isTitleSet === false) {
            cli_set_process_title($this->getTitlePrefix() . $this->getPath());
            $this->isTitleSet = true;
        } else {
            throw new \LogicException('Title is already set.');
        }

        return $this;
    }

    public function setTitlePrefix(string $titlePrefix): ProcessInterface
    {
        if ($this->titlePrefix === null) {
            $this->titlePrefix = $titlePrefix;
        }

        return $this;
    }

    protected function getTitlePrefix(): string
    {
        if ($this->titlePrefix === null) {
            throw new \LogicException('Title prefix is not set.');
        }

        return $this->titlePrefix;
    }

    public function handleSignal(InformationInterface $information): HandlerInterface
    {
        $this->getProcessSignal()->block();
        $this->exit();

        return $this;
    }

    protected function setOrReplaceExitCode(int $exitCode): ProcessInterface
    {
        $this->exitCode = $exitCode;

        return $this;
    }

    public function exit(): void
    {
        $this->getProcessSignal()->block();
        $this->unregisterShutdownMethod();
        $this->getProcessPool()->terminateChildProcesses();
        exit($this->exitCode);
    }

    public function shutdown(): ProcessInterface
    {
        if ($this->isShutdownMethodActive === true) {
            $this->getLogger()->critical("Shutdown method invoked.");
            $this->setOrReplaceExitCode(255);
            $this->exit();
        }

        return $this;
    }

    protected function registerShutdownMethod(): ProcessInterface
    {
        if ($this->isShutdownMethodActive === false) {
            $this->isShutdownMethodActive = true;
            register_shutdown_function([$this, 'shutdown']);
        } else {
            throw new \LogicException('Shutdown method is already active.');
        }

        return $this;
    }

    public function unregisterShutdownMethod(): ProcessInterface
    {
        $this->isShutdownMethodActive = false;

        return $this;
    }

    public function setParentProcessPath(string $parentProcessPath): ProcessInterface
    {
        if ($this->parentProcessPath === null) {
            $this->parentProcessPath = $parentProcessPath;
        } else {
            throw new \LogicException('Parent process path is already set.');
        }

        return $this;
    }

    protected function getParentProcessPath(): string
    {
        if ($this->parentProcessPath === null) {
            throw new \LogicException('Parent process path is not set.');
        }

        return $this->parentProcessPath;
    }

    public function getPath(): string
    {
        if ($this->path === null) {
            $processId = $this->getProcessId();
            $typeId = $this->getTypeId();
            $path = $this->getParentProcessPath() . '/' . $typeId . '[' . $processId . ']';
            $this->path = $path;
        }

        return $this->path;
    }

    public function getTypeId(): string
    {
        return static::class;
    }

    abstract public function start(): ProcessInterface;

    public function setThrottle(int $seconds = 0): ProcessInterface
    {
        if ($this->throttle === null) {
            $this->throttle = $seconds;
        } else {
            throw new \LogicException('Throttle is already set.');
        }

        return $this;
    }

    protected function setProcessId(int $processId): ProcessAbstract
    {
        if ($this->processId === null) {
            $this->processId = $processId;
        } else {
            throw new \LogicException('Process ID is already set.');
        }

        return $this;
    }

    public function getProcessId(): int
    {
        if ($this->processId === null) {
            throw new \LogicException('Process ID is not set.');
        }

        return $this->processId;
    }

    protected function setParentProcessId(int $parentProcessId): ProcessAbstract
    {
        if ($this->parentProcessId === null) {
            $this->parentProcessId = $parentProcessId;
        } else {
            throw new \LogicException('Parent process ID is already set.');
        }

        return $this;
    }

    public function getParentProcessId(): int
    {
        if ($this->parentProcessId === null) {
            throw new \LogicException('Parent process ID is not set.');
        }

        return $this->parentProcessId;
    }

    public function setExitCode(int $exitCode): ProcessInterface
    {
        if ($this->exitCode === null) {
            $this->exitCode = $exitCode;
        } else {
            throw new \LogicException('Exit code is already set.');
        }

        return $this;
    }

    public function getExitCode(): int
    {
        if ($this->exitCode === null) {
            throw new \LogicException('Exit code is not set.');
        }

        return $this->exitCode;
    }

    public function setTerminationSignalNumber(int $terminationSignalNumber): ProcessInterface
    {
        if ($this->terminationSignalNumber === null) {
            $this->terminationSignalNumber = $terminationSignalNumber;
        } else {
            throw new \LogicException('Termination signal number is already set.');
        }

        return $this;
    }

    public function getTerminationSignalNumber(): int
    {
        if ($this->terminationSignalNumber === null) {
            throw new \LogicException('Termination signal number is not set.');
        }

        return $this->terminationSignalNumber;
    }

    public function getParentProcessTerminationSignalNumber(): int
    {
        if ($this->parentProcessTerminationSignalNumber === null) {
            throw new \LogicException('Parent process termination signal number is not set.');
        }

        return $this->parentProcessTerminationSignalNumber;
    }

    public function setParentProcessTerminationSignalNumber(int $parentProcessTerminationSignalNumber)
    {
        if ($this->parentProcessTerminationSignalNumber === null) {
            $this->parentProcessTerminationSignalNumber = $parentProcessTerminationSignalNumber;
        } else {
            throw new \LogicException('Parent process termination signal number is not set.');
        }

        return $this;
    }

    public function setParentProcessUuid(string $parentProcessUuid): ProcessInterface
    {
        if ($this->parentProcessUuid === null) {
            $this->parentProcessUuid = $parentProcessUuid;
        } else {
            throw new \LogicException('Parent process UUID is already set.');
        }

        return $this;
    }

    public function getParentProcessUuid(): string
    {
        if ($this->parentProcessUuid === null) {
            throw new \LogicException('Parent process UUID is not set.');
        }

        return $this->parentProcessUuid;
    }

    public function getUuid(): string
    {
        if ($this->uuid === null) {
            $hostname = gethostname();
            $processUuid = $hostname
                . '-' . gethostbyname($hostname)
                . '-' . $this->getPath()
                . '-' . sprintf('%f', microtime(true))
                . '-' . random_int(0, $this->getUuidMaximumInteger());
            $this->uuid = $processUuid;
        }

        return $this->uuid;
    }

    public function setUuidMaximumInteger(int $uuidMaximumInteger): ProcessInterface
    {
        if ($this->uuidMaximumInteger === null) {
            $this->uuidMaximumInteger = $uuidMaximumInteger;
        } else {
            throw new \LogicException('UUID maximum integer is already set.');
        }

        return $this;
    }

    protected function getUuidMaximumInteger(): int
    {
        if ($this->uuidMaximumInteger === null) {
            throw new \LogicException('UUID maximum integer is not set.');
        }

        return $this->uuidMaximumInteger;
    }
}