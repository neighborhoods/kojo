<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Process\Forked\Exception;
use Neighborhoods\Kojo\Process\Listener\CommandInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Process\JobInterface;
use Neighborhoods\Kojo\Process\ListenerInterface;
use Neighborhoods\Kojo\Process\JobStateChangelogProcessorInterface;

class Strategy extends StrategyAbstract
{
    protected $_pausedListenerProcesses = [];

    public function childProcessExited(ProcessInterface $process): StrategyInterface
    {
        if ($process instanceof JobInterface) {
            $this->_jobProcessExited($process);
        } elseif ($process instanceof ListenerInterface) {
            $this->_listenerProcessExited($process);
        } elseif ($process instanceof JobStateChangelogProcessorInterface) {
            $this->_jobStateChangelogProcessorProcessExited($process);
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
                !$this->_getProcessPool()->isFull()
                && $this->_getProcessPool()->canEnvironmentSustainAdditionProcesses()
                && $listenerProcess->hasMessages()
            ) {
                $listenerProcess->processMessage();
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
        if ($jobProcess->getExitCode() !== 0 && $this->_getProcessPool()->canEnvironmentSustainAdditionProcesses()) {
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

    protected function _jobStateChangelogProcessorProcessExited(JobStateChangelogProcessorInterface $jsclpProcess) : Strategy
    {
        $this->_getProcessPool()->freeChildProcess($jsclpProcess->getProcessId());

        // usually this is where we'd spawn a new JSCLP to take the place of the one that exited, but
        // that is handled by \Neighborhoods\Kojo\Process\Root::pollSingletonProcesses()

        if (!$this->_getProcessPool()->hasAlarm()) {
            $this->_getProcessPool()->setAlarm($this->getMaxAlarmTime());
        }

        return $this;
    }

    public function receivedAlarm(): StrategyInterface
    {
        if (!$this->_getProcessPool()->isFull() && $this->_getProcessPool()->canEnvironmentSustainAdditionProcesses()) {
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
        if ($this->_hasFillProcessTypeCode() && $this->_getProcessPool()->canEnvironmentSustainAdditionProcesses()) {
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
                    while (
                        !$this->_getProcessPool()->isFull() &&
                        $this->_getProcessPool()->canEnvironmentSustainAdditionProcesses() &&
                        $listenerProcess->hasMessages()
                    ) {
                        $listenerProcess->processMessage();
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

    public function handlePotentiallyStrayProcesses() : StrategyInterface
    {
        $this->_getLogger()->notice('SIGKILL of Worker process detected');

        // get the status file for every process
        foreach (glob('/proc/[0-9]*/status') as $procStatusFile) {
            $processId = null;
            $parentProcessId = null;
            $processGroupId = null;

            try {
                // files in /proc/ can be deleted at any time
                // suppress PHP's warning (which will become an error)
                // we'll check for failure after attempting to open
                $procStatusFd = @fopen($procStatusFile, 'r');

                // this file has been deleted (or we don't have permission)
                if ($procStatusFd === false) {
                    continue;
                }

                // parse the file for the IDs above
                while (($line = fgets($procStatusFd))) {
                    [$item] = sscanf($line, "Pid:\t%s");
                    if ($item !== null) {
                        $processId = (int)$item;
                    }

                    [$item] = sscanf($line, "PPid:\t%s");
                    if ($item !== null) {
                        $parentProcessId = (int)$item;
                    }

                    [$item] = sscanf($line, "NSpgid:\t%s");
                    if ($item !== null) {
                        $processGroupId = (int)$item;
                    }

                    // if we've extracted all the information we need,
                    // check if this is a process we need to clean up
                    if ($processId && $parentProcessId && $processGroupId) {
                        if (
                            // was it orphaned
                            $parentProcessId === 1 &&
                            // was it spawned from the same ancestor (i.e. the Server)
                            $processGroupId === $this->_getProcessPool()->getProcess()->getProcessGroupId() &&
                            // guard against false positives
                            // is not the Root
                            $processId !== $this->_getProcessPool()->getProcess()->getProcessId() &&
                            // is not init
                            $processId !== 1
                        ) {
                            $this->_getLogger()->warning(
                                'Terminating orphaned process',
                                [
                                    'process_id' => $processId,
                                    'parent_process_id' => $parentProcessId,
                                    'process_group_id' => $processGroupId,
                                    // Root information is included in the kojo_metadata
                                ]
                            );
                            // SIGKILL must be used here because watchdogs won't handle any signals
                            // any (unexpected) orphan processes that result from this will be
                            // cleaned up in the next pass
                            posix_kill($processId, SIGKILL);
                        }
                        // move on to the next /proc/ file regardless
                        break;
                    }
                }
            } finally {
                if ($procStatusFd !== false) {
                    fclose($procStatusFd);
                }
            }
        }

        return $this;
    }
}
