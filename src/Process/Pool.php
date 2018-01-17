<?php

namespace NHDS\Jobs\Process;

use NHDS\Jobs\Process\Pool\Logger;
use NHDS\Jobs\Process\Pool\Strategy;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\ProcessInterface;

class Pool implements PoolInterface
{
    use Strict\AwareTrait;
    use Logger\AwareTrait;
    use Strategy\AwareTrait;
    const SIGNAL_NUMBER = 'signo';
    const PROP_STARTED  = 'started';
    protected $_info        = [];
    protected $_processes   = [];
    protected $_waitSignals = [
        SIGCHLD,
        SIGALRM,
        SIGINT,
    ];

    protected function _initialize(): PoolInterface
    {
        register_shutdown_function([$this, 'terminateChildProcesses']);
        pcntl_signal(SIGTERM, [$this, 'terminateChildProcesses']);
        pcntl_signal(SIGINT, [$this, 'terminateChildProcesses']);

        return $this;
    }

    public function terminateChildProcesses()
    {
        if (!empty($this->_processes)) {
            $numberOfProcesses = $this->getNumberOfProcesses();
            $this->_getLogger()->debug("Sending termination signal to {$numberOfProcesses} child processes...");
            /** @var ProcessInterface $process */
            foreach ($this->_processes as $process) {
                $processId = $process->getProcessId();
                $processTypeCode = $process->getTypeCode();
                if ($process instanceof ListenerInterface) {
                    posix_kill($processId, SIGKILL);
                    $this->_getLogger()->debug("Sent SIGKILL to Process[{$processId}][{$processTypeCode}].");
                }else {
                    posix_kill($processId, SIGTERM);
                    $this->_getLogger()->debug("Sent SIGTERM to Process[{$processId}][{$processTypeCode}].");
                }
                unset($this->_processes[$processId]);
            }
        }

        return $this;
    }

    public function start(): PoolInterface
    {
        $this->_create(self::PROP_STARTED, true);
        $this->_initialize();
        $this->_getLogger()->info("Process pool started.");
        // Register signals to be handled.
        pcntl_sigprocmask(SIG_BLOCK, $this->_waitSignals);

        // Initialize pool.
        $this->_getProcessPoolStrategy()->initializePool();
        while (true) {
            $this->_getLogger()->debug("Waiting for signal...");
            $this->_info = [];
            pcntl_sigwaitinfo($this->_waitSignals, $this->_info);

            switch ($this->_info[self::SIGNAL_NUMBER]) {
                case SIGCHLD:
                    $this->_handleChildExitSignal();
                    break;
                case SIGALRM:
                    $this->_handleAlarmSignal();
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

    protected function _handleChildExitSignal(): Pool
    {
        while ($processId = pcntl_wait($status, WNOHANG)) {
            if ($processId == -1) {
                $this->_processControlWaitError();
            }
            $processExitCode = pcntl_wexitstatus($status);
            $this->_getLogger()->debug("Process[{$processId}] exited with code [{$processExitCode}]");
            $process = $this->getProcess($processId)->setExitCode($processExitCode);
            $this->_getProcessPoolStrategy()->processExited($process);
            $this->_validateAlarm();
        }
        $this->_getLogger()->debug('Number of processes in pool: ' . $this->getNumberOfProcesses());
        $this->_getProcessPoolStrategy()->currentPendingChildExitsComplete();

        return $this;
    }

    public function getNumberOfProcesses(): int
    {
        return count($this->_processes);
    }

    protected function _processControlWaitError()
    {
        $waitErrorString = var_export(pcntl_strerror(pcntl_get_last_error()), true);
        $this->_getLogger()->emergency('Received wait error, error string: "' . $waitErrorString . '".');
        $signalInformation = var_export($this->_info, true);
        $this->_getLogger()->emergency('Received wait error, signal information: ' . $signalInformation);
        throw new \RuntimeException('Unrecoverable process control wait error.');
    }

    protected function _validateAlarm(): Pool
    {
        $alarmValue = pcntl_alarm(0);
        if ($this->isEmpty()) {
            if ($alarmValue == 0) {
                $this->_getLogger()->emergency('Process pool has no alarms and no processes.');
                throw new \LogicException('Invalid Process pool state.');
            }else {
                $this->_getLogger()->notice('Process pool only has a set alarm.');
            }
        }
        pcntl_alarm($alarmValue);

        return $this;
    }

    public function hasAlarm()
    {
        $hasAlarm = false;
        if (($seconds = pcntl_alarm(0)) > 0) {
            $hasAlarm = true;
        }
        pcntl_alarm($seconds);

        return $hasAlarm;
    }

    protected function _handleAlarmSignal(): Pool
    {
        $this->_getProcessPoolStrategy()->receivedAlarm();

        return $this;
    }

    public function setAlarm(int $seconds): PoolInterface
    {
        $this->_getLogger()->debug('Setting alarm for ' . $seconds . ' seconds.');
        pcntl_alarm($seconds);

        return $this;
    }

    public function isFull(): bool
    {
        return (bool)($this->getNumberOfProcesses() >= $this->_getProcessPoolStrategy()->getMaxProcesses());
    }

    public function isEmpty(): bool
    {
        return (bool)($this->getNumberOfProcesses() === 0);
    }

    public function addProcess(ProcessInterface $process): PoolInterface
    {
        if ($this->isFull()) {
            throw new \LogicException('Process pool is full.');
        }else {
            $process->start();
            $this->_processes[$process->getProcessId()] = $process;
        }

        return $this;
    }

    public function getProcess(int $processId): ProcessInterface
    {
        if (!isset($this->_processes[$processId])) {
            throw new \LogicException("Process is with process ID {$processId} not set.");
        }

        return $this->_processes[$processId];
    }

    public function freeProcess(int $processId): PoolInterface
    {
        if (isset($this->_processes[$processId]) && $this->_processes[$processId] instanceof ProcessInterface) {
            $typeCode = $this->_processes[$processId]->getTypeCode();
            $this->_getLogger()->debug("Freeing Process related to Process[$processId][$typeCode] from Process pool.");
            unset($this->_processes[$processId]);
        }else {
            throw new \LogicException("Process associated to Process[$processId] is not in the Process pool.");
        }

        return $this;
    }

    public function emptyProcesses(): PoolInterface
    {
        $this->_processes = [];

        return $this;
    }
}