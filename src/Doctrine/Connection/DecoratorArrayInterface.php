<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection;

interface DecoratorArrayInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param DecoratorInterface ...$doctrineConnections */
    public function __construct(array $doctrineConnections = array(), int $flags = 0);

    public function offsetGet($index): DecoratorInterface;

    /** @param DecoratorInterface $doctrineConnection */
    public function offsetSet($index, $doctrineConnection);

    /** @param DecoratorInterface $doctrineConnection */
    public function append($doctrineConnection);

    public function current(): DecoratorInterface;

    public function getArrayCopy(): DecoratorArrayInterface;
}
