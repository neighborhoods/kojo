<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker\Queue\Message;

use Neighborhoods\KojoExample\Worker\Queue\MessageInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    public function setWorkerQueueMessage(MessageInterface $workerQueueMessage): self
    {
        $this->_create(MessageInterface::class, $workerQueueMessage);

        return $this;
    }

    protected function getWorkerQueueMessage(): MessageInterface
    {
        return $this->_read(MessageInterface::class);
    }

    protected function hasWorkerQueueMessage(): bool
    {
        return $this->_exists(MessageInterface::class);
    }

    protected function unsetWorkerQueueMessage(): self
    {
        $this->_delete(MessageInterface::class);

        return $this;
    }
}
