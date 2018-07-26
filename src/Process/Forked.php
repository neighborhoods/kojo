<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessAbstract;
use Neighborhoods\Kojo\ProcessInterface;

abstract class Forked extends ProcessAbstract implements ProcessInterface
{
    const FORK_FAILURE_CODE = -1;
    protected $hasForked = false;

    public function start(): ProcessInterface
    {
        $this->setHasForked();
        $processId = $this->getProcessStrategy()->fork();
        if ($processId === self::FORK_FAILURE_CODE) {
            throw new \RuntimeException('Failed to fork a new process.');
        } elseif ($processId > 0) {
            // This is executed in the parent process.
            $this->setProcessId($processId);
        } else {
            // This is executed in the child process.
            $this->initialize();
            $this->getProcessSignal()->decrementWaitCount();
            $this->getProcessPool()->start();
            $this->run();
            $this->exit();
        }

        return $this;
    }

    protected function setHasForked(): ProcessInterface
    {
        if ($this->hasForked === false) {
            $this->hasForked = true;
        } else {
            throw new \LogicException('Process has already forked.');
        }

        return $this;
    }

    abstract protected function run(): Forked;
}