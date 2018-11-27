<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter\Group;

use Neighborhoods\Kojo\Where\Filter\GroupInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param GroupInterface ...$whereFilterGroups */
    public function __construct(array $whereFilterGroups = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($whereFilterGroups)) {
            $this->assertValidArrayType(...array_values($whereFilterGroups));
        }

        parent::__construct($whereFilterGroups, $flags);
    }

    public function offsetGet($index): GroupInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param GroupInterface $whereFilterGroup */
    public function offsetSet($index, $whereFilterGroup)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($whereFilterGroup));
    }

    /** @param GroupInterface $whereFilterGroup */
    public function append($whereFilterGroup)
    {
        $this->assertValidArrayItemType($whereFilterGroup);
        parent::append($whereFilterGroup);
    }

    public function current(): GroupInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(GroupInterface $whereFilterGroup)
    {
        return $whereFilterGroup;
    }

    protected function assertValidArrayType(GroupInterface ... $whereFilterGroups): MapInterface
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
