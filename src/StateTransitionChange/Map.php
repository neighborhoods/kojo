<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange;

use Neighborhoods\Kojo\StateTransitionChangeInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param StateTransitionChangeInterface ...$stateTransitionChanges */
    public function __construct(array $stateTransitionChanges = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($stateTransitionChanges)) {
            $this->assertValidArrayType(...array_values($stateTransitionChanges));
        }

        parent::__construct($stateTransitionChanges, $flags);
    }

    public function offsetGet($index) : StateTransitionChangeInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param StateTransitionChangeInterface $stateTransitionChange */
    public function offsetSet($index, $stateTransitionChange)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($stateTransitionChange));
    }

    /** @param StateTransitionChangeInterface $stateTransitionChange */
    public function append($stateTransitionChange)
    {
        $this->assertValidArrayItemType($stateTransitionChange);
        parent::append($stateTransitionChange);
    }

    public function current() : StateTransitionChangeInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(StateTransitionChangeInterface $stateTransitionChange)
    {
        return $stateTransitionChange;
    }

    protected function assertValidArrayType(StateTransitionChangeInterface ...$stateTransitionChanges) : MapInterface
    {
        return $this;
    }

    public function getArrayCopy() : MapInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray() : array
    {
        return (array)$this;
    }

    public function hydrate(array $array) : MapInterface
    {
        $this->__construct($array);

        return $this;
    }
}
