<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Queue;

/** @codeCoverageIgnore */
interface MessageArrayInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param MessageInterface ...$workerQueueMessages */
    public function __construct(array $workerQueueMessages = array(), int $flags = 0);

    public function offsetGet($index): MessageInterface;

    /** @param MessageInterface $workerQueueMessage */
    public function offsetSet($index, $workerQueueMessage);

    /** @param MessageInterface $workerQueueMessage */
    public function append($workerQueueMessage);

    public function current(): MessageInterface;

    public function getArrayCopy(): MessageArrayInterface;
}
