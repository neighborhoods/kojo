<?php
declare(strict_types=1);

namespace Neighborhoods\Pylon\Symfony\Component;

use Symfony\Component\Finder\Finder;

class FinderArray extends \ArrayIterator implements FinderArrayInterface
{
    /** @param Finder ...$finders */
    public function __construct(array $finders = array(), int $flags = 0)
    {
        if (!empty($finders)) {
            $this->_assertValidArrayType(...$finders);
        }

        parent::__construct($finders, $flags);
    }

    public function offsetGet($index): Finder
    {
        return $this->_assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param Finder $finder */
    public function offsetSet($index, $finder)
    {
        parent::offsetSet($index, $this->_assertValidArrayItemType($finder));
    }

    /** @param Finder $finder */
    public function append($finder)
    {
        $this->_assertValidArrayItemType($finder);
        parent::append($finder);
    }

    public function current(): Finder
    {
        return parent::current();
    }

    protected function _assertValidArrayItemType(Finder $finder)
    {
        return $finder;
    }

    protected function _assertValidArrayType(Finder ...$finders): FinderArrayInterface
    {
        return $this;
    }
}