<?php
declare(strict_types=1);

namespace NHDS\Jobs\Semaphore\Mutex;

use NHDS\Jobs\Semaphore\MutexAbstract;
use NHDS\Jobs\Semaphore\MutexInterface;

class Redis extends MutexAbstract implements RedisInterface
{
    public function testAndSetLock(): bool
    {
        // Has a redis mutex process been forked?
    }

    public function releaseLock(): MutexInterface
    {
        return $this;
    }

    public function hasLock(): bool
    {
        // TODO: Implement hasLock() method.
    }
}