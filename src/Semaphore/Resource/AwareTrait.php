<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource;

use Neighborhoods\Kojo\Semaphore\ResourceInterface;
use Neighborhoods\Kojo\SemaphoreInterface;

trait AwareTrait
{
    public function setSemaphoreResource(ResourceInterface $resource)
    {
        $this->_create(ResourceInterface::class, $resource);

        return $this;
    }

    protected function _getSemaphoreResource(): ResourceInterface
    {
        return $this->_read(ResourceInterface::class);
    }

    protected function _getSemaphoreResourceClone(): ResourceInterface
    {
        return clone $this->_read(ResourceInterface::class);
    }

    protected function _hasSemaphoreResource(): bool
    {
        return $this->_exists(SemaphoreInterface::class);
    }

    protected function _unsetSemaphoreResource(): self
    {
        $this->_delete(SemaphoreInterface::class);

        return $this;
    }
}