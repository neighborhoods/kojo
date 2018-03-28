<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

use NHDS\Jobs\ProcessAbstract;
use NHDS\Jobs\ProcessInterface;
use NHDS\Jobs\Process;

abstract class Forked extends ProcessAbstract implements ProcessInterface
{
    use Process\Pool\Factory\AwareTrait;
    const FORK_FAILURE_CODE = -1;
    const PROP_HAS_FORKED   = 'has_forked';

    public function start(): ProcessInterface
    {
        $this->_create(self::PROP_HAS_FORKED, true);
        $processId = $this->_getProcessStrategy()->fork();
        if ($processId === self::FORK_FAILURE_CODE) {
            throw new \RuntimeException('Failed to fork a new process.');
        }elseif ($processId > 0) {
            // This is executed in the parent process.
            $this->_setProcessId($processId);
        }else {
            // This is executed in the child process.
            $this->_initialize();
            $this->_removeParentProcessPool();
            $this->_startProcessPool();
        }

        return $this;
    }

    protected function _removeParentProcessPool(): Forked
    {
        $this->_getProcessPool()->emptyChildProcesses();
        $this->_unsetProcessPool();

        return $this;
    }

    protected function _startProcessPool(): Forked
    {
        $this->setProcessPool($this->_getProcessPoolFactory()->create());
        $this->_getProcessPool()->setProcess($this);
        $this->_getProcessPool()->start();

        return $this;
    }

    public function processPoolStarted(): ProcessInterface
    {
        $this->_getProcessSignal()->unBlock();
        $this->_run();
        $this->exit(0);

        return $this;
    }

    abstract protected function _run(): Forked;
}