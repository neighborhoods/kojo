<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

use NHDS\Jobs\ProcessInterface;

class Pool extends PoolAbstract implements PoolInterface
{
    const SIGNAL_NUMBER = 'signo';
    const PROP_STARTED  = 'started';
    protected $_signalInformation = [];
    protected $_childProcesses    = [];
    protected $_waitSignals       = [
        SIGCHLD,
        SIGALRM,
        SIGTERM,
        SIGINT,
        SIGHUP,
        SIGQUIT,
        SIGABRT,
    ];

    public function start(): PoolInterface
    {
        $this->_create(self::PROP_STARTED, true);
        $this->_initialize();
        $this->getProcess()->processPoolStarted();

        return $this;
    }

    public function waitForSignal(): PoolInterface
    {
        $this->_getLogger()->info("Waiting for signal...");
        $this->_signalInformation = [];
        pcntl_sigwaitinfo($this->_waitSignals, $this->_signalInformation);
        $signalNumber = $this->_signalInformation[self::SIGNAL_NUMBER];
        $this->_getLogger()->info("Received signal number[$signalNumber].");
        switch ($signalNumber) {
            case SIGCHLD:
                $this->childExitSignal();
                break;
            case SIGALRM:
                $this->alarmSignal();
                break;
            case SIGTERM:
            case SIGINT:
            case SIGHUP:
            case SIGQUIT:
            case SIGABRT:
                $this->getProcess()->receivedSignal($signalNumber, $this->_signalInformation);
                break;
            default:
                throw new \UnexpectedValueException("Unexpected signal number [$signalNumber].");
        }

        return $this;
    }

    public function childExitSignal(): PoolInterface
    {
        while ($childProcessId = pcntl_wait($status, WNOHANG)) {
            if ($childProcessId == -1) {
                $this->_processControlWaitError();
            }
            $childProcessExitCode = pcntl_wexitstatus($status);
            $childProcess = $this->getChildProcess($childProcessId)->setExitCode($childProcessExitCode);
            $this->_getProcessPoolStrategy()->childProcessExited($childProcess);
            $this->_validateAlarm();
        }
        $this->_getProcessPoolStrategy()->currentPendingChildExitsCompleted();

        return $this;
    }

    public function getCountOfChildProcesses(): int
    {
        return count($this->_childProcesses);
    }

    protected function _processControlWaitError()
    {
        $waitErrorString = var_export(pcntl_strerror(pcntl_get_last_error()), true);
        $this->_getLogger()->emergency('Received wait error, error string: "' . $waitErrorString . '".');
        $signalInformation = var_export($this->_signalInformation, true);
        $this->_getLogger()->emergency('Received wait error, signal information: ' . $signalInformation);
        throw new \RuntimeException('Unrecoverable process control wait error.');
    }

    public function addChildProcess(ProcessInterface $childProcess): PoolInterface
    {
        $this->_getProcessSignal()->block();
        if ($this->isFull()) {
            throw new \LogicException('Process pool is full.');
        }else {
            $childProcess->start();
            $this->_childProcesses[$childProcess->getProcessId()] = $childProcess;
            $message = "Forked Process[{$childProcess->getProcessId()}][{$childProcess->getTypeCode()}].";
            $this->_getLogger()->info($message);
        }
        $this->_getProcessSignal()->unBlock();

        return $this;
    }

    public function getChildProcess(int $childProcessId): ProcessInterface
    {
        if (!isset($this->_childProcesses[$childProcessId])) {
            throw new \LogicException("Process with process ID [$childProcessId] not set.");
        }

        return $this->_childProcesses[$childProcessId];
    }

    public function freeChildProcess(int $childProcessId): PoolInterface
    {
        if (isset($this->_childProcesses[$childProcessId])) {
            if ($this->_childProcesses[$childProcessId] instanceof ProcessInterface) {
                $typeCode = $this->_childProcesses[$childProcessId]->getTypeCode();
                $this->_getLogger()->info("Freeing child process related to Process[$childProcessId][$typeCode].");
                unset($this->_childProcesses[$childProcessId]);
            }else {
                $message = "Process associated to Process[$childProcessId] is not an expected type.";
                throw new \UnexpectedValueException($message);
            }
        }else {
            throw new \LogicException("Process associated to Process[$childProcessId] is not in the process pool.");
        }

        return $this;
    }

    public function terminateChildProcesses(): PoolInterface
    {
        $this->_getProcessSignal()->block();
        if (!empty($this->_childProcesses)) {
            /** @var ProcessInterface $process */
            foreach ($this->_childProcesses as $process) {
                $processId = $process->getProcessId();
                $terminationSignalNumber = $process->getTerminationSignalNumber();
                $processTypeCode = $process->getTypeCode();
                posix_kill($processId, $terminationSignalNumber);
                $message = "Sent kill($terminationSignalNumber) to Process[$processId][$processTypeCode].";
                $this->_getLogger()->info($message);
                unset($this->_childProcesses[$processId]);
            }
        }
        $this->_getProcessSignal()->unBlock();

        return $this;
    }

    public function emptyChildProcesses(): PoolInterface
    {
        $this->_childProcesses = [];

        return $this;
    }
}