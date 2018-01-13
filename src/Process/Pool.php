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
    const PROP_SWIMMING = 'swimming';
    protected $_info        = [];
    protected $_processId;
    protected $_processPool = [];
    protected $_configuration;
    protected $_waitSignals = [
        SIGCHLD,
        SIGALRM,
    ];
    protected $_strategy;

    public function initialize(): PoolInterface
    {
        $this->setProcessId(posix_getpid());
        register_shutdown_function([$this, 'terminateChildProcesses']);
        pcntl_signal(SIGTERM, [$this, 'terminateChildProcesses']);

        return $this;
    }

    public function terminateChildProcesses()
    {
        if (!empty($this->_processPool)) {
            $this->_getLogger()->debug('Sending SIGTERM to child processes...');
            /** @var ProcessInterface $process */
            foreach ($this->_processPool as $process) {
                posix_kill($process->getProcessId(), SIGTERM);
                $this->_getLogger()->debug('Sent SIGTERM to Process[' . $process->getProcessId() . '].');
            }
        }

        return $this;
    }

    public function swim(): PoolInterface
    {
        $this->_create(self::PROP_SWIMMING, true);
        $this->_getLogger()->info("ProcessPool started.");
        // Register signals to be handled.
        pcntl_sigprocmask(SIG_BLOCK, $this->_waitSignals);

        // Initialize pool.
        $this->_getStrategy()->initializePool();
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
                default:
                    throw new \UnexpectedValueException('Unexpected blocked signal.');
            }
        }

        $this->_getLogger()->info('ProcessPool is empty.');

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
            $this->_getStrategy()->processExited($process);
            $this->_validateAlarm();
        }
        $this->_getLogger()->debug('Number of processes in Pool: ' . count($this->_processPool));
        $this->_getStrategy()->currentPendingChildExitsComplete();

        return $this;
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
                $this->_getLogger()->emergency('ProcessPool has no alarms and no processes.');
                throw new \LogicException('Invalid ProcessPool state.');
            }else {
                $this->_getLogger()->notice('ProcessPool only has a set alarm.');
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
        $this->_getStrategy()->receivedAlarm();

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
        return (bool)(count($this->_processPool) >= $this->_getStrategy()->getMaxProcesses());
    }

    public function isEmpty(): bool
    {
        return (bool)(count($this->_processPool) == 0);
    }

    public function addProcess(ProcessInterface $process): PoolInterface
    {
        if ($this->isFull()) {
            throw new \LogicException('ProcessPool is full.');
        }else {
            $process->fork($this->_processId);
            $this->_processPool[$process->getProcessId()] = $process;
        }

        return $this;
    }

    public function getProcess(int $processId): ProcessInterface
    {
        if (!isset($this->_processPool[$processId])) {
            throw new \LogicException("Process is with process ID {$processId} not set.");
        }

        return $this->_processPool[$processId];
    }

    public function freeProcess(int $processId): PoolInterface
    {
        if (isset($this->_processPool[$processId]) && $this->_processPool[$processId] instanceof ProcessInterface) {
            $typeCode = $this->_processPool[$processId]->getTypeCode();
            $this->_getLogger()->debug("Freeing Process related to Process[$processId][$typeCode] from ProcessPool.");
            unset($this->_processPool[$processId]);
        }else {
            throw new \LogicException("Process associated to Process[$processId] is not in the ProcessPool.");
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

    public function setProcessId(int $processId): PoolInterface
    {
        if ($this->_processId === null) {
            $this->_processId = $processId;
        }else {
            throw new \LogicException('Process ID is already set.');
        }

        return $this;
    }

    public function resetPool(): PoolInterface
    {
        $this->_processPool = [];

        return $this;
    }
}