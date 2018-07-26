<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Process\PoolInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param PoolInterface ...$pools */
    public function __construct(array $pools = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($pools)) {
            $this->assertValidArrayType(...array_values($pools));
        }

        parent::__construct($pools, $flags);
    }

    public function offsetGet($index): PoolInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param PoolInterface $pool */
    public function offsetSet($index, $pool)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($pool));
    }

    /** @param PoolInterface $pool */
    public function append($pool)
    {
        $this->assertValidArrayItemType($pool);
        parent::append($pool);
    }

    public function current(): PoolInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(PoolInterface $pool)
    {
        return $pool;
    }

    protected function assertValidArrayType(PoolInterface ...$pools): MapInterface
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
