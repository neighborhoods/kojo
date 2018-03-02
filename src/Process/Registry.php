<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

use NHDS\Jobs\ProcessInterface;

class Registry implements RegistryInterface
{
    protected $_processes = [];

    public function pushProcess(ProcessInterface $process): RegistryInterface
    {
        $processId = $process->getProcessId();
        if (isset($this->_processes[$processId])) {
            throw new \LogicException("Process with ID[$processId] is already set.");
        }

        $this->_processes[$processId] = $process;

        return $this;
    }

    public function getLastRegisteredProcess(): ProcessInterface
    {
        return end($this->_processes);
    }
}