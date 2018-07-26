<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job;

use Neighborhoods\Kojo\JobInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param JobInterface ...$jobs */
    public function __construct(array $jobs = array(), int $flags = 0);

    public function offsetGet($index): JobInterface;

    /** @param JobInterface $job */
    public function offsetSet($index, $job);

    /** @param JobInterface $job */
    public function append($job);

    public function current(): JobInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}
