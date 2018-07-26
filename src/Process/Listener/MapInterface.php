<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Listener;

use Neighborhoods\Kojo\Process\ListenerInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param ListenerInterface ...$listeners */
    public function __construct(array $listeners = array(), int $flags = 0);

    public function offsetGet($index): ListenerInterface;

    /** @param ListenerInterface $listener */
    public function offsetSet($index, $listener);

    /** @param ListenerInterface $listener */
    public function append($listener);

    public function current(): ListenerInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}
