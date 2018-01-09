<?php

namespace NHDS\Jobs\Process\Type;

use NHDS\Jobs\Process\Type\Collection\IteratorInterface;
use NHDS\Jobs\ProcessInterface;
use NHDS\Toolkit\Data\Property\Crud;

class Collection implements CollectionInterface
{
    use Crud\AwareTrait;
    protected $_processTypes = [];

    public function addProcessPrototype(ProcessInterface $process)
    {
        $typeCode = $process->getTypeCode();
        if (isset($this->_processTypes[$typeCode])) {
            throw new \LogicException('Process type with code "' . $typeCode . '" is already set.');
        }
        $this->_processTypes[$typeCode] = $process;

        return $this;
    }

    public function &getProcessPrototypes(): array
    {
        return $this->_processTypes;
    }

    public function getProcessTypeClone(string $typeCode): ProcessInterface
    {
        if (!isset($this->_processTypes[$typeCode])) {
            throw new \LogicException('Process type with code "' . $typeCode . '" is not set.');
        }

        return clone $this->_processTypes[$typeCode];
    }

    public function setIterator(IteratorInterface $iterator)
    {
        $iterator->setProcessTypeCollection($this);
        $this->_create(IteratorInterface::class, $iterator);

        return $this;
    }

    public function getIterator(): IteratorInterface
    {
        return $this->_getIterator()->initialize();
    }

    protected function _getIterator(): IteratorInterface
    {
        return $this->_read(IteratorInterface::class);
    }
}