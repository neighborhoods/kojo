<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example\Worker\Queue\Message;

use Neighborhoods\Kojo\Example\Worker\Queue\MessageInterface;

trait AwareTrait
{
    public function setWorkerQueueMessage(MessageInterface $workerQueueMessage): self
    {
        $this->_create(MessageInterface::class, $workerQueueMessage);

        return $this;
    }

    protected function _getWorkerQueueMessage(): MessageInterface
    {
        return $this->_read(MessageInterface::class);
    }

    protected function _getWorkerQueueMessageClone(): MessageInterface
    {
        return clone $this->_getWorkerQueueMessage();
    }

    protected function _hasWorkerQueueMessage(): bool
    {
        return $this->_exists(MessageInterface::class);
    }

    protected function _unsetWorkerQueueMessage(): self
    {
        $this->_delete(MessageInterface::class);

        return $this;
    }
}