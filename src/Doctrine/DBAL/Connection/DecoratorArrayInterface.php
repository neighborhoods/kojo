<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\DBAL\Connection;

/** @codeCoverageIgnore */
interface DecoratorArrayInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param DecoratorInterface ...$v1DoctrineConnectionDecorators */
    public function __construct(array $v1DoctrineConnectionDecorators = array(), int $flags = 0);

    public function offsetGet($index): DecoratorInterface;

    /** @param DecoratorInterface $v1DoctrineConnectionDecorator */
    public function offsetSet($index, $v1DoctrineConnectionDecorator);

    /** @param DecoratorInterface $v1DoctrineConnectionDecorator */
    public function append($v1DoctrineConnectionDecorator);

    public function current(): DecoratorInterface;

    public function getArrayCopy(): DecoratorArrayInterface;

    public function toArray(): array;

    public function hydrate(array $array): DecoratorArrayInterface;
}
