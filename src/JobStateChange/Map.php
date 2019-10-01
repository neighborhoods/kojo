<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange;

use Neighborhoods\Kojo\JobStateChangeInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param JobStateChangeInterface ...$JobStateChanges */
    public function __construct(array $JobStateChanges = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($JobStateChanges)) {
            $this->assertValidArrayType(...array_values($JobStateChanges));
        }

        parent::__construct($JobStateChanges, $flags);
    }

    public function offsetGet($index) : JobStateChangeInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param JobStateChangeInterface $JobStateChange */
    public function offsetSet($index, $JobStateChange)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($JobStateChange));
    }

    /** @param JobStateChangeInterface $JobStateChange */
    public function append($JobStateChange)
    {
        $this->assertValidArrayItemType($JobStateChange);
        parent::append($JobStateChange);
    }

    public function current() : JobStateChangeInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(JobStateChangeInterface $JobStateChange)
    {
        return $JobStateChange;
    }

    protected function assertValidArrayType(JobStateChangeInterface ...$JobStateChanges) : MapInterface
    {
        return $this;
    }

    public function getArrayCopy() : MapInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray() : array
    {
        return (array)$this;
    }

    public function hydrate(array $array) : MapInterface
    {
        $this->__construct($array);

        return $this;
    }
}
