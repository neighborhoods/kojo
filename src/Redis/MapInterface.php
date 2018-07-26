<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param \Redis ...$redisi */
    public function __construct(array $redisi = array(), int $flags = 0);

    public function offsetGet($index): \Redis;

    /** @param \Redis $redis */
    public function offsetSet($index, $redis);

    /** @param \Redis $redis */
    public function append($redis);

    public function current(): \Redis;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}
