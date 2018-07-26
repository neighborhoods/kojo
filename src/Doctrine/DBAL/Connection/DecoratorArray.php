<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\DBAL\Connection;

/** @codeCoverageIgnore */
class DecoratorArray extends \ArrayIterator implements DecoratorArrayInterface
{
    /** @param DecoratorInterface ...$v1DoctrineConnectionDecorators */
    public function __construct(array $v1DoctrineConnectionDecorators = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('DecoratorArray is not empty.');
        }

        if (!empty($v1DoctrineConnectionDecorators)) {
            $this->assertValidArrayType(...$v1DoctrineConnectionDecorators);
        }

        parent::__construct($v1DoctrineConnectionDecorators, $flags);
    }

    public function offsetGet($index): DecoratorInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param DecoratorInterface $v1DoctrineConnectionDecorator */
    public function offsetSet($index, $v1DoctrineConnectionDecorator)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($v1DoctrineConnectionDecorator));
    }

    /** @param DecoratorInterface $v1DoctrineConnectionDecorator */
    public function append($v1DoctrineConnectionDecorator)
    {
        $this->assertValidArrayItemType($v1DoctrineConnectionDecorator);
        parent::append($v1DoctrineConnectionDecorator);
    }

    public function current(): DecoratorInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(DecoratorInterface $v1DoctrineConnectionDecorator)
    {
        return $v1DoctrineConnectionDecorator;
    }

    protected function assertValidArrayType(DecoratorInterface ...$v1DoctrineConnectionDecorators
    ): DecoratorArrayInterface {
        return $this;
    }

    public function getArrayCopy(): DecoratorArrayInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray(): array
    {
        return (array)$this;
    }

    public function hydrate(array $array): DecoratorArrayInterface
    {
        $this->__construct($array);

        return $this;
    }
}
