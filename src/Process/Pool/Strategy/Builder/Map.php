<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy\Builder;

use Neighborhoods\Kojo\Process\Pool\Strategy\BuilderInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param BuilderInterface ...$builders */
    public function __construct(array $builders = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($builders)) {
            $this->assertValidArrayType(...array_values($builders));
        }

        parent::__construct($builders, $flags);
    }

    public function offsetGet($index): BuilderInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param BuilderInterface $builder */
    public function offsetSet($index, $builder)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($builder));
    }

    /** @param BuilderInterface $builder */
    public function append($builder)
    {
        $this->assertValidArrayItemType($builder);
        parent::append($builder);
    }

    public function current(): BuilderInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(BuilderInterface $builder)
    {
        return $builder;
    }

    protected function assertValidArrayType(BuilderInterface ...$builders): MapInterface
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
