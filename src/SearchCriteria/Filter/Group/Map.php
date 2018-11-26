<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group;

use Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface;

/**
 * @codeCoverageIgnore
 */
class Map extends \ArrayIterator implements MapInterface
{

    /**
     * @param \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface ...$SearchCriteriaFilterGroups
     */
    public function __construct(array $SearchCriteriaFilterGroups = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($SearchCriteriaFilterGroups)) {
            $this->assertValidArrayType(...array_values($SearchCriteriaFilterGroups));
        }

        parent::__construct($SearchCriteriaFilterGroups, $flags);
    }

    public function offsetGet($index) : \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /**
     * @param \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface $SearchCriteriaFilterGroup
     */
    public function offsetSet($index, $SearchCriteriaFilterGroup)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($SearchCriteriaFilterGroup));
    }

    /**
     * @param \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface $SearchCriteriaFilterGroup
     */
    public function append($SearchCriteriaFilterGroup)
    {
        $this->assertValidArrayItemType($SearchCriteriaFilterGroup);
        parent::append($SearchCriteriaFilterGroup);
    }

    public function current() : \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(\Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface $SearchCriteriaFilterGroup)
    {
        return $SearchCriteriaFilterGroup;
    }

    protected function assertValidArrayType(\Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface ... $SearchCriteriaFilterGroups) : MapInterface
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

