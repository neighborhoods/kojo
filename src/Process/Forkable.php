<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

use NHDS\Jobs\ProcessAbstract;
use NHDS\Jobs\ProcessInterface;

abstract class Forkable extends ProcessAbstract implements ProcessInterface
{
    const PROP_HAS_FORKED = 'has_forked';

    public function start(): ProcessInterface
    {
        $this->_create(self::PROP_HAS_FORKED, true);
        $processId = $this->_getProcessStrategy()->fork();
        if ($processId === -1) {
            throw new \RuntimeException('Failed to fork new Process.');
        }elseif ($processId > 0) {
            // This is executed in the Process Pool.
            $this->_initialize($processId);
            $this->_getLogger()->debug("Forked Process[{$this->getProcessId()}][{$this->getTypeCode()}].");
        }else {
            // This is executed in the Process.
            $this->_initialize();
            if ($this->_hasProcessPool()) {
                $this->_getProcessPool()->emptyProcesses();
                $this->_deleteProcessPool();
            }

            $this->_getLogger()->debug("Running Process...");
            $this->_run();
            $this->_getLogger()->debug("Process finished running.");
            $this->_exit(0);
        }

        return $this;
    }

    abstract protected function _run(): Forkable;
}