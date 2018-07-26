<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\Process\Signal\HandlerInterface;
use Neighborhoods\Kojo\Process\Signal\InformationInterface;

class Pool extends PoolAbstract implements PoolInterface
{
    use Process\Map\AwareTrait;
    protected $isStarted = false;

    public function start(): PoolInterface
    {
        if ($this->isStarted === true) {
            throw new \LogicException('Process pool is already started.');
        }
        $this->initialize();

        return $this;
    }

    public function handleSignal(InformationInterface $signalInformation): HandlerInterface
    {
        $signalNumber = $signalInformation->getSignalNumber();
        switch ($signalNumber) {
            case SIGCHLD:
                $this->childExitSignal($signalInformation);
                break;
            case SIGALRM:
                $this->alarmSignal($signalInformation);
                break;
            default:
                throw new \UnexpectedValueException("Unexpected signal number[$signalNumber].");
        }

        return $this;
    }

    protected function childExitSignal(InformationInterface $information): PoolInterface
    {
        $childProcessId = $information->getProcessId();
        if (isset($this->getProcessMap()[$childProcessId])) {
            $childProcessExitCode = $information->getExitValue();
            $childProcess = $this->getChildProcess($information->getProcessId())->setExitCode($childProcessExitCode);
            $this->getProcessPoolStrategy()->childProcessExited($childProcess);
            $this->validateAlarm();
            $this->getProcessPoolStrategy()->currentPendingChildExitsCompleted();
        } else {
            $processId = $this->getProcess()->getProcessId();
            $this->getLogger()->notice("Child process[$childProcessId] is not in the pool for process[$processId].");
        }

        return $this;
    }

    public function freeChildProcess(int $childProcessId): PoolInterface
    {
        if (isset($this->_childProcesses[$childProcessId])) {
            if ($this->getProcessMap()[$childProcessId] instanceof ProcessInterface) {
                $typeCode = $this->getProcessMap()[$childProcessId]->getTypeId();
                $this->getLogger()->info("Freeing child process related to process[$childProcessId][$typeCode].");
                unset($this->getProcessMap()[$childProcessId]);
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
        return count($this->getProcessMap());
    }

    public function addChildProcess(ProcessInterface $childProcess): PoolInterface
    {
        try {
            $this->getProcessSignal()->incrementWaitCount();
            if ($this->isFull()) {
                throw new \LogicException('Process pool is full.');
            } else {
                $childProcess->start();
                $this->getProcessMap()[$childProcess->getProcessId()] = $childProcess;
                $message = "Forked process[{$childProcess->getProcessId()}][{$childProcess->getTypeId()}].";
                $this->getLogger()->info($message);
            }
            $this->getProcessSignal()->decrementWaitCount();
        } catch (\Throwable $throwable) {
            $this->getProcessSignal()->decrementWaitCount();
            throw $throwable;
        }

        return $this;
    }

    public function getChildProcess(int $childProcessId): ProcessInterface
    {
        if (!isset($this->getProcessMap()[$childProcessId])) {
            throw new \LogicException("Process with process ID[$childProcessId] not set.");
        }

        return $this->getProcessMap()[$childProcessId];
    }

    public function terminateChildProcesses(): PoolInterface
    {
        $this->getProcessSignal()->block();
        if (!empty($this->getProcessMap())) {
            /** @var ProcessInterface $process */
            foreach ($this->getProcessMap() as $process) {
                $processId = $process->getProcessId();
                $terminationSignalNumber = $process->getTerminationSignalNumber();
                $processTypeId = $process->getTypeId();
                posix_kill($processId, $terminationSignalNumber);
                $message = "Sent kill($terminationSignalNumber) to process[$processId][$processTypeId].";
                $this->getLogger()->info($message);
                unset($this->getProcessMap()[$processId]);
            }
        }

        return $this;
    }

    public function emptyChildProcesses(): PoolInterface
    {
        $this->unsetProcessMap();

        return $this;
    }
}