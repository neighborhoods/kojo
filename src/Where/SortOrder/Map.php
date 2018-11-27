<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\SortOrder;

use Neighborhoods\Kojo\Where\SortOrderInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param SortOrderInterface ...$sortorders */
    public function __construct(array $sortorders = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($sortorders)) {
            $this->assertValidArrayType(...array_values($sortorders));
        }

        parent::__construct($sortorders, $flags);
    }

    public function offsetGet($index): SortOrderInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param SortOrderInterface $sortorder */
    public function offsetSet($index, $sortorder)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($sortorder));
    }

    /** @param SortOrderInterface $sortorder */
    public function append($sortorder)
    {
        $this->assertValidArrayItemType($sortorder);
        parent::append($sortorder);
    }

    public function current(): SortOrderInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(SortOrderInterface $sortorder)
    {
        return $sortorder;
    }

    protected function assertValidArrayType(SortOrderInterface ...$sortorders): MapInterface
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
