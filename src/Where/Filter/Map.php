<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter;

use Neighborhoods\Kojo\Where\FilterInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param FilterInterface ...$filters */
    public function __construct(array $filters = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($filters)) {
            $this->assertValidArrayType(...array_values($filters));
        }

        parent::__construct($filters, $flags);
    }

    public function offsetGet($index): FilterInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param FilterInterface $filter */
    public function offsetSet($index, $filter)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($filter));
    }

    /** @param FilterInterface $filter */
    public function append($filter)
    {
        $this->assertValidArrayItemType($filter);
        parent::append($filter);
    }

    public function current(): FilterInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(FilterInterface $filter)
    {
        return $filter;
    }

    protected function assertValidArrayType(FilterInterface ...$filters): MapInterface
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
