<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource;

use Neighborhoods\Kojo\Semaphore\ResourceInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param ResourceInterface ...$resources */
    public function __construct(array $resources = array(), int $flags = 0);

    public function offsetGet($index): ResourceInterface;

    /** @param ResourceInterface $resource */
    public function offsetSet($index, $resource);

    /** @param ResourceInterface $resource */
    public function append($resource);

    public function current(): ResourceInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}
