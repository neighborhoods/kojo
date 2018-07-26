<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Listener;

use Neighborhoods\Kojo\Process\ListenerInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param ListenerInterface ...$listeners */
    public function __construct(array $listeners = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($listeners)) {
            $this->assertValidArrayType(...array_values($listeners));
        }

        parent::__construct($listeners, $flags);
    }

    public function offsetGet($index): ListenerInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param ListenerInterface $listener */
    public function offsetSet($index, $listener)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($listener));
    }

    /** @param ListenerInterface $listener */
    public function append($listener)
    {
        $this->assertValidArrayItemType($listener);
        parent::append($listener);
    }

    public function current(): ListenerInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(ListenerInterface $listener)
    {
        return $listener;
    }

    protected function assertValidArrayType(ListenerInterface ...$listeners): MapInterface
    {
        return $this;
    }

    public function getArrayCopy(): MapInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray(): array
    {
        return (array)$this;
    }

    public function hydrate(array $array): MapInterface
    {
        $this->__construct($array);

        return $this;
    }
}
