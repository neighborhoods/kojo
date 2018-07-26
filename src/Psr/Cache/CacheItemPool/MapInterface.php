<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Psr\Cache\CacheItemPool;

use Psr\Cache\CacheItemPoolInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param CacheItemPoolInterface ...$cacheitempools */
    public function __construct(array $cacheitempools = array(), int $flags = 0);

    public function offsetGet($index): CacheItemPoolInterface;

    /** @param CacheItemPoolInterface $cacheitempool */
    public function offsetSet($index, $cacheitempool);

    /** @param CacheItemPoolInterface $cacheitempool */
    public function append($cacheitempool);

    public function current(): CacheItemPoolInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}
