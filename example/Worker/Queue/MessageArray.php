<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example\Worker\Queue;

class MessageArray extends \ArrayIterator implements MessageArrayInterface
{
    /** @param \Neighborhoods\Kojo\Example\Worker\Queue\Message ...$workerQueueMessages */
    public function __construct(array $workerQueueMessages = array(), int $flags = 0)
    {
        if (!empty($workerQueueMessages)) {
            $this->_assertValidArrayType(...$workerQueueMessages);
        }

        parent::__construct($workerQueueMessages, $flags);
    }

    public function offsetGet($index): \Neighborhoods\Kojo\Example\Worker\Queue\Message
    {
        return $this->_assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param \Neighborhoods\Kojo\Example\Worker\Queue\Message $workerQueueMessage */
    public function offsetSet($index, $workerQueueMessage)
    {
        parent::offsetSet($index, $this->_assertValidArrayItemType($workerQueueMessage));
    }

    /** @param \Neighborhoods\Kojo\Example\Worker\Queue\Message $workerQueueMessage */
    public function append($workerQueueMessage)
    {
        $this->_assertValidArrayItemType($workerQueueMessage);
        parent::append($workerQueueMessage);
    }

    public function current(): \Neighborhoods\Kojo\Example\Worker\Queue\Message
    {
        return parent::current();
    }

    protected function _assertValidArrayItemType(\Neighborhoods\Kojo\Example\Worker\Queue\Message $workerQueueMessage)
    {
        return $workerQueueMessage;
    }

    protected function _assertValidArrayType(\Neighborhoods\Kojo\Example\Worker\Queue\Message ...$workerQueueMessages
    ): MessageArrayInterface{
        return $this;
    }
}