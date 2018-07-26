<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Type;

use Neighborhoods\Kojo\Job\TypeInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param TypeInterface ...$types */
    public function __construct(array $types = array(), int $flags = 0);

    public function offsetGet($index): TypeInterface;

    /** @param TypeInterface $type */
    public function offsetSet($index, $type);

    /** @param TypeInterface $type */
    public function append($type);

    public function current(): TypeInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}
