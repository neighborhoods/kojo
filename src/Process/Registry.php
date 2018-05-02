<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessInterface;

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