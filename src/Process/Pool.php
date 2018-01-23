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
        SIGINT,
        SIGTERM,
    ];

    public function start(): PoolInterface
    {
        $this->_create(self::PROP_STARTED, true);
        $this->_initialize();
        $this->_getLogger()->info("Process pool started.");
        // Register signals to be handled.
        pcntl_sigprocmask(SIG_BLOCK, $this->_waitSignals);
        while (true) {
            $this->_getLogger()->debug("Waiting for signal...");
            $this->_signalInformation = [];
            pcntl_sigwaitinfo($this->_waitSignals, $this->_signalInformation);

            switch ($this->_signalInformation[self::SIGNAL_NUMBER]) {
                case SIGCHLD:
                    $this->_childExitSignal();
                    break;
                case SIGALRM:
                    $this->_alarmSignal();
                    break;
                case SIGINT:
                case SIGTERM:
                    $this->_getLogger()->debug('Handling termination signal...');
                    $this->terminateChildProcesses();
                    break 2;
                default:
                    throw new \UnexpectedValueException('Unexpected blocked signal.');
            }
        }

        $this->_getLogger()->info('Exiting process pool.');

        return $this;
    }

    protected function _childExitSignal(): PoolInterface
    {
        while ($childProcessId = pcntl_wait($status, WNOHANG)) {
            if ($childProcessId == -1) {
                $this->_processControlWaitError();
            }
            $childProcessExitCode = pcntl_wexitstatus($status);
            $this->_getLogger()->debug("Process[$childProcessId] exited with code [$childProcessExitCode]");
            $childProcess = $this->getChildProcess($childProcessId)->setExitCode($childProcessExitCode);
            $this->_getProcessPoolStrategy()->childProcessExited($childProcess);
            $this->_validateAlarm();
        }
        $this->_getLogger()->debug('Number of child processes in pool: ' . $this->getCountOfChildProcesses());
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
        if ($this->isFull()) {
            throw new \LogicException('Process pool is full.');
        }else {
            $childProcess->start();
            $this->_childProcesses[$childProcess->getProcessId()] = $childProcess;
        }

        return $this;
    }

    public function getChildProcess(int $childProcessId): ProcessInterface
    {
        if (!isset($this->_childProcesses[$childProcessId])) {
            throw new \LogicException("Process is with process ID $childProcessId not set.");
        }

        return $this->_childProcesses[$childProcessId];
    }

    public function freeChildProcess(int $childProcessId): PoolInterface
    {
        if (isset($this->_childProcesses[$childProcessId])) {
            if ($this->_childProcesses[$childProcessId] instanceof ProcessInterface) {
                $typeCode = $this->_childProcesses[$childProcessId]->getTypeCode();
                $this->_getLogger()->debug("Freeing child process related to Process[$childProcessId][$typeCode].");
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
        if (!empty($this->_childProcesses)) {
            $numberOfProcesses = $this->getCountOfChildProcesses();
            $this->_getLogger()->debug("Sending termination signal to $numberOfProcesses child processes...");
            /** @var ProcessInterface $process */
            foreach ($this->_childProcesses as $process) {
                $processId = $process->getProcessId();
                $processTypeCode = $process->getTypeCode();
                if ($process instanceof ListenerInterface) {
                    posix_kill($processId, SIGKILL);
                    $this->_getLogger()->debug("Sent SIGKILL to Process[$processId][$processTypeCode].");
                }else {
                    posix_kill($processId, SIGTERM);
                    $this->_getLogger()->debug("Sent SIGTERM to Process[$processId][$processTypeCode].");
                }
                unset($this->_childProcesses[$processId]);
            }
        }

        return $this;
    }

    public function emptyChildProcesses(): PoolInterface
    {
        $this->_childProcesses = [];

        return $this;
    }
}