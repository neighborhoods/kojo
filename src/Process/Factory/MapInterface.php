<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Factory;

use Neighborhoods\Kojo\Process\FactoryInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param FactoryInterface ...$factorys */
    public function __construct(array $factorys = array(), int $flags = 0);

    public function offsetGet($index): FactoryInterface;

    /** @param FactoryInterface $factory */
    public function offsetSet($index, $factory);

    /** @param FactoryInterface $factory */
    public function append($factory);

    public function current(): FactoryInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}
