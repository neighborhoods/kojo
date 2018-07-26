<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Psr\Cache\CacheItemPool;

use Psr\Cache\CacheItemPoolInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param CacheItemPoolInterface ...$cacheitempools */
    public function __construct(array $cacheitempools = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($cacheitempools)) {
            $this->assertValidArrayType(...array_values($cacheitempools));
        }

        parent::__construct($cacheitempools, $flags);
    }

    public function offsetGet($index): CacheItemPoolInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param CacheItemPoolInterface $cacheitempool */
    public function offsetSet($index, $cacheitempool)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($cacheitempool));
    }

    /** @param CacheItemPoolInterface $cacheitempool */
    public function append($cacheitempool)
    {
        $this->assertValidArrayItemType($cacheitempool);
        parent::append($cacheitempool);
    }

    public function current(): CacheItemPoolInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(CacheItemPoolInterface $cacheitempool)
    {
        return $cacheitempool;
    }

    protected function assertValidArrayType(CacheItemPoolInterface ...$cacheitempools): MapInterface
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
