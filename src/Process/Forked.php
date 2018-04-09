<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessAbstract;
use Neighborhoods\Kojo\ProcessInterface;

abstract class Forked extends ProcessAbstract implements ProcessInterface
{
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
            $this->_getProcessSignal()->decrementWaitCount();
            $this->_getProcessPool()->start();
            $this->_run();
            $this->exit(0);
        }

        return $this;
    }

    abstract protected function _run(): Forked;
}