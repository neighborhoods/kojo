<?php
declare(strict_types=1);

namespace Neighborhoods\Pylon\Symfony\Component;

use Symfony\Component\Finder\Finder;

interface FinderArrayInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param Finder ...$finders */
    public function __construct(array $finders = array(), int $flags = 0);

    public function offsetGet($index): Finder;

    /** @param Finder $finder */
    public function offsetSet($index, $finder);

    /** @param Finder $finder */
    public function append($finder);

    public function current(): Finder;
}