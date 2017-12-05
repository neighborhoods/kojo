<?php

namespace NHDS\Jobs\Semaphore\Mutex;

use NHDS\Jobs\Semaphore\ResourceInterface;

interface MutexInterface
{
    public function setIsBlocking(bool $isBlocking): MutexInterface;

    public function testAndSetLock(): bool;

    public function releaseLock(): MutexInterface;

    public function setResource(ResourceInterface $resource): MutexInterface;
}