<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter\Group;

use Neighborhoods\Kojo\Where\Filter\GroupInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param GroupInterface ...$whereFilterGroups */
    public function __construct(array $whereFilterGroups = [], int $flags = 0);

    public function offsetGet($index): GroupInterface;

    /** @param GroupInterface $whereFilterGroup */
    public function offsetSet($index, $whereFilterGroup);

    /** @param GroupInterface $whereFilterGroup */
    public function append($whereFilterGroup);

    public function current(): GroupInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}
