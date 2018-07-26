<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Schema\Version;

use Neighborhoods\Kojo\Db\Schema\VersionInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param VersionInterface ...$versions */
    public function __construct(array $versions = array(), int $flags = 0);

    public function offsetGet($index): VersionInterface;

    /** @param VersionInterface $version */
    public function offsetSet($index, $version);

    /** @param VersionInterface $version */
    public function append($version);

    public function current(): VersionInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}
