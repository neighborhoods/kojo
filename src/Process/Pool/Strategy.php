<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Process\WorkerInterface;
use Neighborhoods\Kojo\Process\ListenerInterface;
use Neighborhoods\Kojo\Process;

class Strategy extends StrategyAbstract
{
    use Process\Repository\AwareTrait;
    use Process\Listener\Map\AwareTrait;

    public function childProcessExited(ProcessInterface $process): StrategyInterface
    {
        if ($process instanceof WorkerInterface) {
            $this->workerProcessExited($process);
        } elseif ($process instanceof ListenerInterface) {
            $this->listenerProcessExited($process);
        } else {
            $className = get_class($process);
            throw new \UnexpectedValueException("Unexpected process class[$className].");
        }

        return $this;
    }

    protected function listenerProcessExited(ListenerInterface $listenerProcess): Strategy
    {
        if ($listenerProcess->getExitCode() !== 0) {
            $this->pauseListenerProcess($listenerProcess);
        } else {
            while (
                $listenerProcess->hasMessages()
                && !$this->getProcessPool()->isFull()
                && $this->getProcessPool()->canEnvironmentSustainAdditionProcesses()
            ) {
                $listenerProcess->processMessages();
            }

            if ($this->getProcessPool()->isFull()) {
                $this->pauseListenerProcess($listenerProcess);
            } else {
                $this->getProcessPool()->freeChildProcess($listenerProcess->getProcessId());
                $replacementListenerProcess = $this->getProcessRepository()->create($listenerProcess->getTypeId());
                $this->getProcessPool()->addChildProcess($replacementListenerProcess);
            }
        }

        if (!$this->getProcessPool()->hasAlarm()) {
            $this->getProcessPool()->setAlarm($this->getMaxAlarmTime());
        }

        return $this;
    }

    public function currentPendingChildExitsCompleted(): StrategyInterface
    {
        if ($this->hasPausedListenerProcess()) {
            $this->unPauseListenerProcesses();
        } else {
            if (!$this->getProcessPool()->hasAlarm()) {
                $this->getProcessPool()->setAlarm($this->getMaxAlarmTime());
            }
        }

        return $this;
    }

    protected function workerProcessExited(WorkerInterface $jobProcess): Strategy
    {
        $this->getProcessPool()->freeChildProcess($jobProcess->getProcessId());
        if ($jobProcess->getExitCode() !== 0 && $this->getProcessPool()->canEnvironmentSustainAdditionProcesses()) {
            $replacementProcess = $this->getProcessRepository()->create($jobProcess->getTypeId());
            $replacementProcess->setThrottle($this->getChildProcessWaitThrottle());
            $this->getProcessPool()->addChildProcess($replacementProcess);
            if (!$this->getProcessPool()->hasAlarm()) {
                $this->getProcessPool()->setAlarm($this->getMaxAlarmTime());
            }
        }

        return $this;
    }

    public function receivedAlarm(): StrategyInterface
    {
        if (!$this->getProcessPool()->isFull() && $this->getProcessPool()->canEnvironmentSustainAdditionProcesses()) {
            if ($this->hasPausedListenerProcess()) {
                $this->unPauseListenerProcesses();
            } else {
                $alarmProcessTypeCode = $this->getAlarmProcessTypeId();
                $alarmProcess = $this->getProcessRepository()->create($alarmProcessTypeCode);
                $this->getProcessPool()->addChildProcess($alarmProcess);
            }
        }
        if (!$this->getProcessPool()->hasAlarm()) {
            $this->getProcessPool()->setAlarm($this->getMaxAlarmTime());
        }

        return $this;
    }

    public function initializePool(): StrategyInterface
    {
        $this->getProcessPool()->setAlarm($this->getMaxAlarmTime());
        $this->getProcessRepository()->applyProcessPool($this->getProcessPool());
        foreach ($this->getProcessRepository()->getAll() as $process) {
            $this->getProcessPool()->addChildProcess($process);
        }
        if ($this->hasFillProcessTypeId() && $this->getProcessPool()->canEnvironmentSustainAdditionProcesses()) {
            while (!$this->getProcessPool()->isFull()) {
                $fillProcess = $this->getProcessRepository()->create($this->getFillProcessTypeId());
                $this->getProcessPool()->addChildProcess($fillProcess);
            }
        }

        return $this;
    }

    protected function pauseListenerProcess(ListenerInterface $listenerProcess): Strategy
    {
        $listenerProcessId = $listenerProcess->getProcessId();
        if (!isset($this->getProcessListenerMap()[$listenerProcessId])) {
            $this->getProcessPool()->freeChildProcess($listenerProcessId);
            $this->getProcessListenerMap()[$listenerProcessId] = $listenerProcess;
        } else {
            throw new \LogicException('Listener process is already paused.');
        }

        return $this;
    }

    protected function hasPausedListenerProcess(): bool
    {
        return !empty($this->getProcessListenerMap());
    }

    protected function unPauseListenerProcesses(): Strategy
    {
        if ($this->hasPausedListenerProcess()) {
            foreach ($this->getProcessListenerMap() as $processId => $listenerProcess) {
                if (!$this->getProcessPool()->isFull()) {
                    $newListenerProcess = $this->getProcessRepository()->create($listenerProcess->getTypeId());
                    while (!$this->getProcessPool()->isFull() && $listenerProcess->hasMessages()) {
                        $listenerProcess->processMessages();
                    }
                    if (!$this->getProcessPool()->isFull()) {
                        unset($this->getProcessListenerMap()[$processId]);
                        $this->getProcessPool()->addChildProcess($newListenerProcess);
                    }
                } else {
                    break;
                }
            }
        } else {
            throw new \LogicException('There are no paused listener processes.');
        }

        return $this;
    }
}