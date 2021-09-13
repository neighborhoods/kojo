<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Process\Signal\HandlerInterface;
use Neighborhoods\Kojo\Process\Signal\InformationInterface;

class Pool extends PoolAbstract implements PoolInterface
{
    const PROP_STARTED = 'started';
    protected $_childProcesses = [];

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

        if ($information->getExitValue() === SIGKILL) {
            $this->_getLogger()->info('SIGKILL detected');

            $this->inspectProcDirectory();
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

    private function inspectProcDirectory() : PoolInterface
    {
        // get the status file for every process
        foreach (glob('/proc/[0-9]*/status') as $procStatusFile) {
            $processId = null;
            $parentProcessId = null;
            $processGroupId = null;

            try {
                $procStatusFd = fopen($procStatusFile, 'r');

                // parse the file for the IDs above
                while (($line = fgets($procStatusFd))) {
                    list($item) = sscanf($line, "Pid:\t%s");
                    if ($item !== null) {
                        $processId = (int)$item;
                    }

                    list($item) = sscanf($line, "PPid:\t%s");
                    if ($item !== null) {
                        $parentProcessId = (int)$item;
                    }

                    list($item) = sscanf($line, "NSpgid:\t%s");
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
                            $processGroupId === $this->getProcess()->getProcessGroupId() &&
                            // guard against false positives
                            // is not the Root
                            $processId !== $this->getProcess()->getProcessId() &&
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
