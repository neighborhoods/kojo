<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource;

use Neighborhoods\Kojo\Semaphore\ResourceInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param ResourceInterface ...$resources */
    public function __construct(array $resources = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($resources)) {
            $this->assertValidArrayType(...array_values($resources));
        }

        parent::__construct($resources, $flags);
    }

    public function offsetGet($index): ResourceInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param ResourceInterface $resource */
    public function offsetSet($index, $resource)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($resource));
    }

    /** @param ResourceInterface $resource */
    public function append($resource)
    {
        $this->assertValidArrayItemType($resource);
        parent::append($resource);
    }

    public function current(): ResourceInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(ResourceInterface $resource)
    {
        return $resource;
    }

    protected function assertValidArrayType(ResourceInterface ...$resources): MapInterface
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
