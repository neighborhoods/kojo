<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange;

use Neighborhoods\Kojo\JobStateChangeInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param JobStateChangeInterface ...$JobStateChanges */
    public function __construct(array $JobStateChanges = [], int $flags = 0);

    public function offsetGet($index) : JobStateChangeInterface;

    /** @param JobStateChangeInterface $JobStateChange */
    public function offsetSet($index, $JobStateChange);

    /** @param JobStateChangeInterface $JobStateChange */
    public function append($JobStateChange);

    public function current() : JobStateChangeInterface;

    public function getArrayCopy() : MapInterface;

    public function toArray() : array;

    public function hydrate(array $array) : MapInterface;
}
