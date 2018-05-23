<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example\Worker\Queue;

use Neighborhoods\Kojo\Example\Worker\QueueInterface;

trait AwareTrait
{
    public function setWorkerQueue(QueueInterface $workerQueue): self
    {
        $this->_create(QueueInterface::class, $workerQueue);

        return $this;
    }

    protected function _getWorkerQueue(): QueueInterface
    {
        return $this->_read(QueueInterface::class);
    }

    protected function _getWorkerQueueClone(): QueueInterface
    {
        return clone $this->_getWorkerQueue();
    }

    protected function _hasWorkerQueue(): bool
    {
        return $this->_exists(QueueInterface::class);
    }

    protected function _unsetWorkerQueue(): self
    {
        $this->_delete(QueueInterface::class);

        return $this;
    }
}