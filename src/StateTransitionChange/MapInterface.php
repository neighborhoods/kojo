<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange;

use Neighborhoods\Kojo\StateTransitionChangeInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param StateTransitionChangeInterface ...$stateTransitionChanges */
    public function __construct(array $stateTransitionChanges = [], int $flags = 0);

    public function offsetGet($index) : StateTransitionChangeInterface;

    /** @param StateTransitionChangeInterface $stateTransitionChange */
    public function offsetSet($index, $stateTransitionChange);

    /** @param StateTransitionChangeInterface $stateTransitionChange */
    public function append($stateTransitionChange);

    public function current() : StateTransitionChangeInterface;

    public function getArrayCopy() : MapInterface;

    public function toArray() : array;

    public function hydrate(array $array) : MapInterface;
}
