<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param ProcessInterface ...$processs */
    public function __construct(array $processs = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($processs)) {
            $this->assertValidArrayType(...array_values($processs));
        }

        parent::__construct($processs, $flags);
    }

    public function offsetGet($index): ProcessInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param ProcessInterface $process */
    public function offsetSet($index, $process)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($process));
    }

    /** @param ProcessInterface $process */
    public function append($process)
    {
        $this->assertValidArrayItemType($process);
        parent::append($process);
    }

    public function current(): ProcessInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(ProcessInterface $process)
    {
        return $process;
    }

    protected function assertValidArrayType(ProcessInterface ...$processs): MapInterface
    {
        return $this;
    }

    public function getArrayCopy(): MapInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray(): array
    {
        return (array)$this;
    }

    public function hydrate(array $array): MapInterface
    {
        $this->__construct($array);

        return $this;
    }
}
