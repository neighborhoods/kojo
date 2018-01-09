<?php

namespace NHDS\Jobs\Process\Type;

use NHDS\Jobs\ProcessInterface;

trait  AwareTrait
{
    protected $_types = [];

    public function addProcessType(ProcessInterface $process)
    {
        $typeCode = $process->getTypeCode();
        if (isset($this->_types[$typeCode])) {
            throw new \LogicException('Process type is already set.');
        }
        $this->_types[$typeCode] = $process;

        return $this;
    }

    protected function _getProcessTypeClone(string $typeCode): ProcessInterface
    {
        if (!isset($this->_types[$typeCode])) {
            throw new \LogicException('Process type is not set.');
        }

        return clone $this->_types[$typeCode];
    }
}