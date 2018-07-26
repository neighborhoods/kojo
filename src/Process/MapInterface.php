<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param ProcessInterface ...$processs */
    public function __construct(array $processs = array(), int $flags = 0);

    public function offsetGet($index): ProcessInterface;

    /** @param ProcessInterface $process */
    public function offsetSet($index, $process);

    /** @param ProcessInterface $process */
    public function append($process);

    public function current(): ProcessInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}
