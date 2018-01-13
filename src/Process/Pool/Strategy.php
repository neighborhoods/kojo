<?php

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\ProcessInterface;
use NHDS\Jobs\Process\JobInterface;
use NHDS\Jobs\Process\ListenerInterface;

class Strategy extends StrategyAbstract
{
    protected $_pausedListenerProcesses = [];

    public function processExited(ProcessInterface $process): StrategyInterface
    {
        if ($process instanceof JobInterface) {
            $this->_handleJobProcessExit($process);
        }elseif ($process instanceof ListenerInterface) {
            $this->_handleListenerExit($process);
        }else {
            throw new \LogicException('Unhandled Process class.');
        }

        return $this;
    }

    protected function _handleListenerExit(ListenerInterface $listenerProcess): Strategy
    {
        if ($listenerProcess->getExitCode() !== 0) {
            $this->_pauseListenerProcess($listenerProcess);
        }else {
            $this->_getLogger()->debug('Processing listener messages...');
            while (!$this->_getPool()->isFull() && $listenerProcess->hasMessages()) {
                $listenerProcess->processMessages();
            }
            $this->_getLogger()->debug('Finished processing listener messages.');

            if ($this->_getPool()->isFull()) {
                $this->_pauseListenerProcess($listenerProcess);
            }else {
                $this->_getPool()->freeProcess($listenerProcess->getProcessId());
                $typeCode = $listenerProcess->getTypeCode();
                $this->_getPool()->addProcess($this->_getProcessCollection()->getProcessPrototypeClone($typeCode));
            }
        }

        $this->_getPool()->setAlarm();

        return $this;
    }

    public function currentPendingChildExitsComplete(): StrategyInterface
    {
        if ($this->_hasPausedListenerProcess()) {
            $this->_unPauseListenerProcesses();
        }else {
            $this->_getPool()->setAlarm();
        }

        return $this;
    }

    protected function _handleJobProcessExit(JobInterface $jobProcess): Strategy
    {
        $this->_getPool()->freeProcess($jobProcess->getProcessId());
        if ($jobProcess->getExitCode() !== 0) {
            $processId = $jobProcess->getProcessId();
            $this->_getLogger()->debug("Replacing Process for exit error from Process[$processId].");
            $this->_getLogger()->debug("Throttling replacement Process for Process[$processId]].");
            $typeCode = $jobProcess->getTypeCode();
            $replacementProcess = $this->_getProcessCollection()->getProcessPrototypeClone($typeCode);
            $replacementProcess->setThrottle($this->getProcessWaitThrottle());
            $this->_getPool()->addProcess($replacementProcess);
            $this->_getPool()->setAlarm();
        }

        return $this;
    }

    public function receivedAlarm(): StrategyInterface
    {
        $this->_getLogger()->debug("Received alarm.");
        if ($this->_getPool()->isFull()) {
            $this->_getLogger()->notice("ProcessPool is full.");
            $this->_getLogger()->notice("Could not allocate Process for alarm request.");
        }else {
            if ($this->_hasPausedListenerProcess()) {
                $this->_unPauseListenerProcesses();
            }else {
                $this->_getPool()->addProcess($this->_getProcessCollection()->getProcessPrototypeClone('job'));
            }
        }
        $this->_getLogger()->debug("Resetting the alarm.");
        $this->_getPool()->setAlarm();

        return $this;
    }

    public function initializePool(): StrategyInterface
    {
        $this->_getPool()->setAlarm();
        foreach ($this->_getProcessCollection()->getIterator() as $process) {
            $typeCode = $process->getTypeCode();
            $this->_getPool()->addProcess($this->_getProcessCollection()->getProcessPrototypeClone($typeCode));
        }

        return $this;
    }

    protected function _pauseListenerProcess(ListenerInterface $listenerProcess): Strategy
    {
        $listenerProcessId = $listenerProcess->getProcessId();
        if (!isset($this->_pausedListenerProcesses[$listenerProcessId])) {
            $this->_getLogger()->debug('Pausing Listener[' . $listenerProcessId . '].');
            $this->_getPool()->freeProcess($listenerProcessId);
            $this->_pausedListenerProcesses[$listenerProcessId] = $listenerProcess;
        }else {
            throw new \LogicException('Listener Process is already paused.');
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
                if (!$this->_getPool()->isFull()) {
                    $typeCode = $listenerProcess->getTypeCode();
                    $this->_getLogger()->debug('Un-pausing Listener[' . $processId . '][' . $typeCode . '].');
                    $newListenerProcess = $this->_getProcessCollection()->getProcessPrototypeClone($typeCode);
                    while (!$this->_getPool()->isFull() && $listenerProcess->hasMessages()) {
                        $listenerProcess->processMessages();
                    }
                    if (!$this->_getPool()->isFull()) {
                        unset($this->_pausedListenerProcesses[$processId]);
                        $this->_getPool()->addProcess($newListenerProcess);
                    }
                }else {
                    break;
                }
            }
        }else {
            throw new \LogicException('There are no paused Listener Processes.');
        }

        return $this;
    }
}