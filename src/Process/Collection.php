<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Process\Collection\IteratorInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Collection implements CollectionInterface
{
    use Defensive\AwareTrait;
    const PROP_APPLIED_POOL = 'applied_pool';
    protected $_processPrototypes = [];

    public function addProcessPrototype(ProcessInterface $process): CollectionInterface
    {
        $typeCode = $process->getTypeCode();
        if (isset($this->_processPrototypes[$typeCode])) {
            throw new \LogicException('Process type with code "' . $typeCode . '" is already set.');
        }
        $this->_processPrototypes[$typeCode] = $process;

        return $this;
    }

    public function &getProcessPrototypes(): array
    {
        return $this->_processPrototypes;
    }

    public function getProcessPrototypeClone(string $typeCode): ProcessInterface
    {
        if (!isset($this->_processPrototypes[$typeCode])) {
            throw new \LogicException('Process type with code "' . $typeCode . '" is not set.');
        }

        return clone $this->_processPrototypes[$typeCode];
    }

    public function setIterator(IteratorInterface $iterator)
    {
        $iterator->setProcessCollection($this);
        $this->_create(IteratorInterface::class, $iterator);

        return $this;
    }

    public function applyProcessPool(PoolInterface $pool): CollectionInterface
    {
        $this->_create(self::PROP_APPLIED_POOL, true);
        /** @var ProcessInterface $processPrototype */
        foreach ($this->_processPrototypes as $processPrototype) {
            $processPrototype->setProcessPool($pool);
            $processPrototype->setParentProcessPath($pool->getProcess()->getPath());
            $processPrototype->setParentProcessUuid($pool->getProcess()->getUuid());
            $parentProcessTerminationSignalNumber = $pool->getProcess()->getTerminationSignalNumber();
            $processPrototype->setParentProcessTerminationSignalNumber($parentProcessTerminationSignalNumber);
        }

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