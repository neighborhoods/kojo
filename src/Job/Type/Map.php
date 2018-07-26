<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Type;

use Neighborhoods\Kojo\Job\TypeInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param TypeInterface ...$types */
    public function __construct(array $types = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($types)) {
            $this->assertValidArrayType(...array_values($types));
        }

        parent::__construct($types, $flags);
    }

    public function offsetGet($index): TypeInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param TypeInterface $type */
    public function offsetSet($index, $type)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($type));
    }

    /** @param TypeInterface $type */
    public function append($type)
    {
        $this->assertValidArrayItemType($type);
        parent::append($type);
    }

    public function current(): TypeInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(TypeInterface $type)
    {
        return $type;
    }

    protected function assertValidArrayType(TypeInterface ...$types): MapInterface
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
