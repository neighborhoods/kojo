<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

use NHDS\Jobs\ProcessInterface;

trait AwareTrait
{
    public function setProcess(ProcessInterface $process)
    {
        $this->_create(ProcessInterface::class, $process);

        return $this;
    }

    protected function _getProcess(): ProcessInterface
    {
        return $this->_read(ProcessInterface::class);
    }

    protected function _getProcessClone(): ProcessInterface
    {
        return clone $this->_getProcess();
    }

    protected function _hasProcess(): bool
    {
        return $this->_exists(ProcessInterface::class);
    }

    protected function _deleteProcess()
    {
        $this->_delete(ProcessInterface::class);

        return $this;
    }
}