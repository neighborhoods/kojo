<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Mutex;

use Neighborhoods\Kojo\Semaphore\MutexInterface;

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