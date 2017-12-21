<?php

namespace NHDS\Jobs;

use NHDS\Jobs\Semaphore\ResourceInterface;

interface SemaphoreInterface
{
    public function testAndSetLock(ResourceInterface $resource): bool;

    public function releaseLock(ResourceInterface $resource): SemaphoreInterface;

    public function hasLock(ResourceInterface $resource): bool;
}