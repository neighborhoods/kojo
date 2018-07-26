<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Factory;

use Neighborhoods\Kojo\Process\FactoryInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param FactoryInterface ...$factorys */
    public function __construct(array $factorys = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($factorys)) {
            $this->assertValidArrayType(...array_values($factorys));
        }

        parent::__construct($factorys, $flags);
    }

    public function offsetGet($index): FactoryInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param FactoryInterface $factory */
    public function offsetSet($index, $factory)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($factory));
    }

    /** @param FactoryInterface $factory */
    public function append($factory)
    {
        $this->assertValidArrayItemType($factory);
        parent::append($factory);
    }

    public function current(): FactoryInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(FactoryInterface $factory)
    {
        return $factory;
    }

    protected function assertValidArrayType(FactoryInterface ...$factorys): MapInterface
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
