<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Process\Listener\CommandInterface;
use Neighborhoods\Kojo\Process\Signal\HandlerInterface;
use Neighborhoods\Kojo\Process\Signal\InformationInterface;
use Neighborhoods\Kojo\ProcessInterface;

class Pool extends PoolAbstract implements PoolInterface
{
    const PROP_STARTED = 'started';
    /** @var array|ProcessInterface[] */
    protected $_childProcesses = [];
    protected $_hasReceivedSigQuit = false;

    public function start(): PoolInterface
    {
        $this->_create(self::PROP_STARTED, true);
        $this->_initialize();

        return $this;
    }

    public function handleSignal(InformationInterface $signalInformation): HandlerInterface
    {
        $signalNumber = $signalInformation->getSignalNumber();
        switch ($signalNumber) {
            case SIGCHLD:
                $this->_childExitSignal($signalInformation);
                break;
            case SIGALRM:
                $this->_alarmSignal($signalInformation);
                break;
            case SIGQUIT:
                $this->_create(self::PROP_RECEIVED_SIG_QUIT, true);
                $this->setHasReceivedSigQuit(true);
                $this->propagateSignalToChildren(SIGQUIT);
                break;
            default:
                throw new \UnexpectedValueException("Unexpected signal number[$signalNumber].");
        }

        return $this;
    }


    protected function _childExitSignal(InformationInterface $information): PoolInterface
    {
        $childProcessId = $information->getProcessId();
        if (isset($this->_childProcesses[$childProcessId])) {
            $childProcessExitCode = $information->getExitValue();
            $childProcess = $this->getChildProcess($information->getProcessId())->setExitCode($childProcessExitCode);
            $this->_getProcessPoolStrategy()->childProcessExited($childProcess);
            $this->_validateAlarm();
            $this->_getProcessPoolStrategy()->currentPendingChildExitsCompleted();
        } else {
            $processId = $this->_getProcess()->getProcessId();
            $this->_getLogger()->debug("Child process[$childProcessId] is not in the pool for process[$processId].");
        }

        return $this;
    }

    public function freeChildProcess(int $childProcessId): PoolInterface
    {
        if (isset($this->_childProcesses[$childProcessId])) {
            if ($this->_childProcesses[$childProcessId] instanceof ProcessInterface) {
                $typeCode = $this->_childProcesses[$childProcessId]->getTypeCode();
                $this->_getLogger()->debug("Freeing child process related to process[$childProcessId][$typeCode].");
                unset($this->_childProcesses[$childProcessId]);
            } else {
                $message = "Process associated to process[$childProcessId] is not an expected type.";
                throw new \UnexpectedValueException($message);
            }
        } else {
            throw new \LogicException("Process associated to process[$childProcessId] is not in the process pool.");
        }

        return $this;
    }

    public function getCountOfChildProcesses(): int
    {
        return count($this->_childProcesses);
    }

    public function getCountOfNonListenerChildProcesses() : int
    {
        $nonListenerChildProcess = 0;

        foreach ($this->_childProcesses as $childProcess) {
            if (!($childProcess instanceof ListenerAbstract)) {
                $nonListenerChildProcess++;
            }
        }
        return $nonListenerChildProcess;
    }

    public function addChildProcess(ProcessInterface $childProcess): PoolInterface
    {
        if ($this->isFull()) {
            throw new \LogicException('Process pool is full.');
        } else {
            $childProcess->start();
            $this->_childProcesses[$childProcess->getProcessId()] = $childProcess;
            $message = "Forked process[{$childProcess->getProcessId()}][{$childProcess->getTypeCode()}].";
            $this->_getLogger()->debug($message);
        }

        return $this;
    }

    public function getChildProcess(int $childProcessId): ProcessInterface
    {
        if (!isset($this->_childProcesses[$childProcessId])) {
            throw new \LogicException("Process with process ID[$childProcessId] not set.");
        }
        $childProcess = $this->_childProcesses[$childProcessId];

        return $childProcess;
    }

    public function terminateChildProcesses(): PoolInterface
    {
        if (!empty($this->_childProcesses)) {
            /** @var ProcessInterface $process */
            foreach ($this->_childProcesses as $process) {
                $processId = $process->getProcessId();
                $terminationSignalNumber = $process->getTerminationSignalNumber();
                $processTypeCode = $process->getTypeCode();
                posix_kill($processId, $terminationSignalNumber);
                $this->_getLogger()->debug(
                    sprintf(
                        'Sent kill[%s] to process[%s][%s].',
                        $terminationSignalNumber,
                        $processId,
                        $processTypeCode
                    )
                );
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

    public function shouldEnvironmentCreateAdditionalProcesses() : bool
    {
        $exists = $this->_exists(self::PROP_RECEIVED_SIG_QUIT);
        if ($exists) {
            $return = !$this->_read(self::PROP_RECEIVED_SIG_QUIT);
        } else {
            $return = true;
        }

        if (!$return) {
            $this->_getLogger()->warning(
                'Pool is draining due to SIGQUIT',
                ['count_of_non_listener_child_processes' => $this->getCountOfNonListenerChildProcesses()]
            );
        }

        return $return;
    }

    public function propagateSignalToChildren(int $signalNumber) : void
    {
        foreach ($this->_childProcesses as $childProcess) {
            $running = posix_kill($childProcess->getProcessId(), $signalNumber);
            if (!$running){
                $this->_getLogger()->notice('had zombie',);
                unset($this->_childProcesses[$childProcess->getProcessId()]);
            }
        }
    }
}
