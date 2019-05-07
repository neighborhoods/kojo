<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Process\Forked\Exception;
use Neighborhoods\Kojo\Process\Listener\CommandInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Process\JobInterface;
use Neighborhoods\Kojo\Process\ListenerInterface;

class Strategy extends StrategyAbstract
{
    protected $_pausedListenerProcesses = [];

    public function childProcessExited(ProcessInterface $process): StrategyInterface
    {
        if ($process instanceof JobInterface) {
            $this->_jobProcessExited($process);
        } elseif ($process instanceof ListenerInterface) {
            $this->_listenerProcessExited($process);
        } else {
            $className = get_class($process);
            throw new \UnexpectedValueException("Unexpected process class[$className].");
        }

        return $this;
    }

    protected function _listenerProcessExited(ListenerInterface $listenerProcess): Strategy
    {
        if ($listenerProcess->getExitCode() !== 0) {
            $this->_pauseListenerProcess($listenerProcess);
        } else {
            while (
                $listenerProcess->hasMessages()
                && !$this->_getProcessPool()->isFull()
                && $this->canEnvironmentSustainAdditionalProcesses()
            ) {
                $listenerProcess->processMessages();
            }

            if ($this->_getProcessPool()->isFull()) {
                $this->_pauseListenerProcess($listenerProcess);
            } else {
                $this->_getProcessPool()->freeChildProcess($listenerProcess->getProcessId());
                $typeCode = $listenerProcess->getTypeCode();
                $replacementListenerProcess = $this->_getProcessCollection()->getProcessPrototypeClone($typeCode);
                try {
                    $this->_getProcessPool()->addChildProcess($replacementListenerProcess);
                } catch (Exception $forkedException) {
                    $this->_pauseListenerProcess($listenerProcess);
                    $this->_getLogger()->critical($forkedException->getMessage(), ['exception' => $forkedException]);
                }
            }
        }

        if (!$this->_getProcessPool()->hasAlarm()) {
            $this->_getProcessPool()->setAlarm($this->getMaxAlarmTime());
        }

        return $this;
    }

    public function currentPendingChildExitsCompleted(): StrategyInterface
    {
        if ($this->_hasPausedListenerProcess()) {
            $this->_unPauseListenerProcesses();
        } else {
            if (!$this->_getProcessPool()->hasAlarm()) {
                $this->_getProcessPool()->setAlarm($this->getMaxAlarmTime());
            }
        }

        return $this;
    }

    protected function _jobProcessExited(JobInterface $jobProcess): Strategy
    {
        $this->_getProcessPool()->freeChildProcess($jobProcess->getProcessId());
        if ($jobProcess->getExitCode() !== 0 && $this->canEnvironmentSustainAdditionalProcesses()) {
            $typeCode = $jobProcess->getTypeCode();
            $replacementProcess = $this->_getProcessCollection()->getProcessPrototypeClone($typeCode);
            $replacementProcess->setThrottle($this->getChildProcessWaitThrottle());
            try {
                $this->_getProcessPool()->addChildProcess($replacementProcess);
            } catch (Exception $forkedException) {
                $this->_getLogger()->critical($forkedException->getMessage(), ['exception' => $forkedException]);
            }
            if (!$this->_getProcessPool()->hasAlarm()) {
                $this->_getProcessPool()->setAlarm($this->getMaxAlarmTime());
            }
        }

        return $this;
    }

    public function receivedAlarm(): StrategyInterface
    {
        if (!$this->_getProcessPool()->isFull() && $this->canEnvironmentSustainAdditionalProcesses()) {
            if ($this->_hasPausedListenerProcess()) {
                $this->_unPauseListenerProcesses();
            } else {
                $alarmProcessTypeCode = $this->_getAlarmProcessTypeCode();
                $alarmProcess = $this->_getProcessCollection()->getProcessPrototypeClone($alarmProcessTypeCode);
                try {
                    $this->_getProcessPool()->addChildProcess($alarmProcess);
                } catch (Exception $forkedException) {
                    $this->_getLogger()->critical($forkedException->getMessage(), ['exception' => $forkedException]);
                }
            }
        }
        if (!$this->_getProcessPool()->hasAlarm()) {
            $this->_getProcessPool()->setAlarm($this->getMaxAlarmTime());
        }

        return $this;
    }

    public function initializePool(): StrategyInterface
    {
        $this->_getProcessPool()->setAlarm($this->getMaxAlarmTime());
        $this->_getProcessCollection()->applyProcessPool($this->_getProcessPool());
        foreach ($this->_getProcessCollection() as $process) {
            try {
                $this->_getProcessPool()->addChildProcess($process);
            } catch (Exception $forkedException) {
                $this->_getLogger()->critical($forkedException->getMessage(), ['exception' => $forkedException]);
                if ($process instanceof CommandInterface) {
                    $this->_getProcessPool()->getProcess()->exit();
                }
            }
        }
        if ($this->_hasFillProcessTypeCode() && $this->canEnvironmentSustainAdditionalProcesses()) {
            while (!$this->_getProcessPool()->isFull()) {
                $fillProcessTypeCode = $this->_getFillProcessTypeCode();
                $fillProcess = $this->_getProcessCollection()->getProcessPrototypeClone($fillProcessTypeCode);
                try {
                    $this->_getProcessPool()->addChildProcess($fillProcess);
                } catch (Exception $forkedException) {
                    $this->_getLogger()->critical($forkedException->getMessage(), ['exception' => $forkedException]);
                }
            }
        }

        return $this;
    }

    protected function _pauseListenerProcess(ListenerInterface $listenerProcess): Strategy
    {
        $listenerProcessId = $listenerProcess->getProcessId();
        if (!isset($this->_pausedListenerProcesses[$listenerProcessId])) {
            $this->_getProcessPool()->freeChildProcess($listenerProcessId);
            $this->_pausedListenerProcesses[$listenerProcessId] = $listenerProcess;
        } else {
            throw new \LogicException('Listener process is already paused.');
        }

        return $this;
    }

    protected function _hasPausedListenerProcess(): bool
    {
        return !empty($this->_pausedListenerProcesses);
    }

    protected function _unPauseListenerProcesses(): Strategy
    {
        if ($this->_hasPausedListenerProcess()) {
            foreach ($this->_pausedListenerProcesses as $processId => $listenerProcess) {
                if (!$this->_getProcessPool()->isFull()) {
                    $typeCode = $listenerProcess->getTypeCode();
                    $newListenerProcess = $this->_getProcessCollection()->getProcessPrototypeClone($typeCode);
                    while (!$this->_getProcessPool()->isFull() && $listenerProcess->hasMessages()) {
                        $listenerProcess->processMessages();
                    }
                    if (!$this->_getProcessPool()->isFull()) {
                        try {
                            $this->_getProcessPool()->addChildProcess($newListenerProcess);
                            unset($this->_pausedListenerProcesses[$processId]);
                        } catch (Exception $forkedException) {
                            $this->_getLogger()->critical($forkedException->getMessage(), ['exception' => $forkedException]);
                        }
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
