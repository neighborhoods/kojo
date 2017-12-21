<?php

namespace NHDS\Jobs\Semaphore\Resource;

use NHDS\Jobs\Semaphore\ResourceInterface;

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
}