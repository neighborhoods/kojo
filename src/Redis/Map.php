<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param \Redis ...$redisi */
    public function __construct(array $redisi = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($redisi)) {
            $this->assertValidArrayType(...array_values($redisi));
        }

        parent::__construct($redisi, $flags);
    }

    public function offsetGet($index): \Redis
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param \Redis $redis */
    public function offsetSet($index, $redis)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($redis));
    }

    /** @param \Redis $redis */
    public function append($redis)
    {
        $this->assertValidArrayItemType($redis);
        parent::append($redis);
    }

    public function current(): \Redis
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(\Redis $redis)
    {
        return $redis;
    }

    protected function assertValidArrayType(\Redis ...$redisi): MapInterface
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
