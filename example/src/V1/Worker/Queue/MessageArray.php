<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Queue;

/** @codeCoverageIgnore */
class MessageArray extends \ArrayIterator implements MessageArrayInterface
{
    /** @param MessageInterface ...$workerQueueMessages */
    public function __construct(array $workerQueueMessages = array(), int $flags = 0)
    {
        if (!empty($workerQueueMessages)) {
            $this->_assertValidArrayType(...$workerQueueMessages);
        }

        parent::__construct($workerQueueMessages, $flags);
    }

    public function offsetGet($index): MessageInterface
    {
        return $this->_assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param MessageInterface $workerQueueMessage */
    public function offsetSet($index, $workerQueueMessage)
    {
        parent::offsetSet($index, $this->_assertValidArrayItemType($workerQueueMessage));
    }

    /** @param MessageInterface $workerQueueMessage */
    public function append($workerQueueMessage)
    {
        $this->_assertValidArrayItemType($workerQueueMessage);
        parent::append($workerQueueMessage);
    }

    public function current(): MessageInterface
    {
        return parent::current();
    }

    protected function _assertValidArrayItemType(MessageInterface $workerQueueMessage)
    {
        return $workerQueueMessage;
    }

    protected function _assertValidArrayType(MessageInterface ...$workerQueueMessages): MessageArrayInterface
    {
        return $this;
    }

    public function getArrayCopy(): MessageArrayInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }
}
