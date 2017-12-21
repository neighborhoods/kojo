<?php

namespace NHDS\Jobs\Semaphore\Mutex;

use NHDS\Jobs\Semaphore\MutexInterface;

trait AwareTrait
{
    public function setMutex(MutexInterface $job)
    {
        $this->_create(MutexInterface::class, $job);

        return $this;
    }

    protected function _getMutex(): MutexInterface
    {
        return $this->_read(MutexInterface::class);
    }

    protected function _getMutexClone(): MutexInterface
    {
        return clone $this->_getMutex();
    }
}