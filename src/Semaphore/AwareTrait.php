<?php

namespace NHDS\Jobs\Semaphore;

use NHDS\Jobs\SemaphoreInterface;

trait AwareTrait
{
    public function setSemaphore(SemaphoreInterface $semaphore)
    {
        $this->_create(SemaphoreInterface::class, $semaphore);

        return $this;
    }

    protected function _getSemaphore(): SemaphoreInterface
    {
        return $this->_read(SemaphoreInterface::class);
    }

    protected function _getSemaphoreClone(): SemaphoreInterface
    {
        return clone $this->_getSemaphore();
    }
}