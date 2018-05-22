<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection;

class DecoratorArray extends \ArrayIterator implements DecoratorArrayInterface
{
    /** @param DecoratorInterface ...$doctrineConnections */
    public function __construct(array $doctrineConnections = array(), int $flags = 0)
    {
        if (!empty($doctrineConnections)) {
            $this->_assertValidArrayType(...$doctrineConnections);
        }

        parent::__construct($doctrineConnections, $flags);
    }

    public function offsetGet($index): DecoratorInterface
    {
        return $this->_assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param DecoratorInterface $doctrineConnection */
    public function offsetSet($index, $doctrineConnection)
    {
        parent::offsetSet($index, $this->_assertValidArrayItemType($doctrineConnection));
    }

    /** @param DecoratorInterface $doctrineConnection */
    public function append($doctrineConnection)
    {
        $this->_assertValidArrayItemType($doctrineConnection);
        parent::append($doctrineConnection);
    }

    public function current(): DecoratorInterface
    {
        return parent::current();
    }

    protected function _assertValidArrayItemType(DecoratorInterface $doctrineConnection)
    {
        return $doctrineConnection;
    }

    protected function _assertValidArrayType(DecoratorInterface ...$doctrineConnections): DecoratorArrayInterface
    {
        return $this;
    }

    public function getArrayCopy(): DecoratorArrayInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }
}
