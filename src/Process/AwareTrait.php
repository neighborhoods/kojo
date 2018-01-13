<?php

namespace NHDS\Jobs\Process;

use NHDS\Jobs\ProcessInterface;

trait AwareTrait
{
    protected $_types = [];

    public function addProcessPrototype(ProcessInterface $process)
    {
        $typeCode = $process->getTypeCode();
        if (isset($this->_types[$typeCode])) {
            throw new \LogicException('Process prototype is already set.');
        }
        $this->_types[$typeCode] = $process;

        return $this;
    }

    protected function _getProcessPrototypeClone(string $typeCode): ProcessInterface
    {
        if (!isset($this->_types[$typeCode])) {
            throw new \LogicException('Process prototype is not set.');
        }

        return clone $this->_types[$typeCode];
    }
}