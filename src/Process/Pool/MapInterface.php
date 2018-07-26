<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Process\PoolInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param PoolInterface ...$pools */
    public function __construct(array $pools = array(), int $flags = 0);

    public function offsetGet($index): PoolInterface;

    /** @param PoolInterface $pool */
    public function offsetSet($index, $pool);

    /** @param PoolInterface $pool */
    public function append($pool);

    public function current(): PoolInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}
