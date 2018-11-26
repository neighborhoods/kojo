<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group;

use Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface;

/**
 * @codeCoverageIgnore
 */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{

    /**
     * @param \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface ...$SearchCriteriaFilterGroups
     */
    public function __construct(array $SearchCriteriaFilterGroups = [], int $flags = 0);
    public function offsetGet($index) : \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface;
    /**
     * @param \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface $SearchCriteriaFilterGroup
     */
    public function offsetSet($index, $SearchCriteriaFilterGroup);
    /**
     * @param \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface $SearchCriteriaFilterGroup
     */
    public function append($SearchCriteriaFilterGroup);
    public function current() : \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface;
    public function getArrayCopy() : MapInterface;
    public function toArray() : array;
    public function hydrate(array $array) : MapInterface;

}

