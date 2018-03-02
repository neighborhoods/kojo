<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\ProcessInterface;
use NHDS\Jobs\Process\JobInterface;
use NHDS\Jobs\Process\ListenerInterface;

class Strategy extends StrategyAbstract
{
    protected $_pausedListenerProcesses = [];

    public function childProcessExited(ProcessInterface $process): StrategyInterface
    {
        if ($process instanceof JobInterface) {
            $this->_jobProcessExited($process);
        }elseif ($process instanceof ListenerInterface) {
            $this->_listenerProcessExited($process);
        }else {
            throw new \UnexpectedValueException('Unexpected process class.');
        }

        return $this;
    }

    protected function _listenerProcessExited(ListenerInterface $listenerProcess): Strategy
    {
        if ($listenerProcess->getExitCode() !== 0) {
            $this->_pauseListenerProcess($listenerProcess);
        }else {
            $this->_getLogger()->debug('Processing listener messages...');
            while (!$this->_getProcessPool()->isFull() && $listenerProcess->hasMessages()) {
                $listenerProcess->processMessages();
            }
            $this->_getLogger()->debug('Finished processing listener messages.');

            if ($this->_getProcessPool()->isFull()) {
                $this->_pauseListenerProcess($listenerProcess);
            }else {
                $this->_getProcessPool()->freeChildProcess($listenerProcess->getProcessId());
                $typeCode = $listenerProcess->getTypeCode();
                $replacementListenerProcess = $this->_getProcessCollection()->getProcessPrototypeClone($typeCode);
                $this->_getProcessPool()->addChildProcess($replacementListenerProcess);
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
        }else {
            if (!$this->_getProcessPool()->hasAlarm()) {
                $this->_getProcessPool()->setAlarm($this->getMaxAlarmTime());
            }
        }

        return $this;
    }

    protected function _jobProcessExited(JobInterface $jobProcess): Strategy
    {
        $this->_getProcessPool()->freeChildProcess($jobProcess->getProcessId());
        if ($jobProcess->getExitCode() !== 0) {
            $processId = $jobProcess->getProcessId();
            $this->_getLogger()->debug("Replacing process for exit error from Process[$processId].");
            $this->_getLogger()->debug("Throttling replacement process for Process[$processId]].");
            $typeCode = $jobProcess->getTypeCode();
            $replacementProcess = $this->_getProcessCollection()->getProcessPrototypeClone($typeCode);
            $replacementProcess->setThrottle($this->getChildProcessWaitThrottle());
            $this->_getProcessPool()->addChildProcess($replacementProcess);
            if (!$this->_getProcessPool()->hasAlarm()) {
                $this->_getProcessPool()->setAlarm($this->getMaxAlarmTime());
            }
        }

        return $this;
    }

    public function receivedAlarm(): StrategyInterface
    {
        $this->_getLogger()->debug("Received alarm signal.");
        if ($this->_getProcessPool()->isFull()) {
            $this->_getLogger()->notice("Process pool is full.");
            $this->_getLogger()->notice("Could not allocate process for alarm signal.");
        }else {
            if ($this->_hasPausedListenerProcess()) {
                $this->_unPauseListenerProcesses();
            }else {
                $alarmProcessTypeCode = $this->_getAlarmProcessTypeCode();
                $alarmProcess = $this->_getProcessCollection()->getProcessPrototypeClone($alarmProcessTypeCode);
                $this->_getProcessPool()->addChildProcess($alarmProcess);
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
            $this->_getProcessPool()->addChildProcess($process);
        }
        if ($this->_hasFillProcessTypeCode()) {
            while (!$this->_getProcessPool()->isFull()) {
                $fillProcessTypeCode = $this->_getFillProcessTypeCode();
                $fillProcess = $this->_getProcessCollection()->getProcessPrototypeClone($fillProcessTypeCode);
                $this->_getProcessPool()->addChildProcess($fillProcess);
            }
        }

        return $this;
    }

    protected function _pauseListenerProcess(ListenerInterface $listenerProcess): Strategy
    {
        $listenerProcessId = $listenerProcess->getProcessId();
        if (!isset($this->_pausedListenerProcesses[$listenerProcessId])) {
            $this->_getLogger()->debug('Pausing Listener[' . $listenerProcessId . '].');
            $this->_getProcessPool()->freeChildProcess($listenerProcessId);
            $this->_pausedListenerProcesses[$listenerProcessId] = $listenerProcess;
        }else {
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
                    $this->_getLogger()->debug('Un-pausing Listener[' . $processId . '][' . $typeCode . '].');
                    $newListenerProcess = $this->_getProcessCollection()->getProcessPrototypeClone($typeCode);
                    while (!$this->_getProcessPool()->isFull() && $listenerProcess->hasMessages()) {
                        $listenerProcess->processMessages();
                    }
                    if (!$this->_getProcessPool()->isFull()) {
                        unset($this->_pausedListenerProcesses[$processId]);
                        $this->_getProcessPool()->addChildProcess($newListenerProcess);
                    }
                }else {
                    break;
                }
            }
        }else {
            throw new \LogicException('There are no paused listener processes.');
        }

        return $this;
    }
}