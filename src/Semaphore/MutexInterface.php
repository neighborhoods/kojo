<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore;

interface MutexInterface
{
    public function setIsBlocking(bool $isBlocking): MutexInterface;

    public function testAndSetLock(): bool;

    /**
     * Soft check for whether a mutex is available
     *
     * DOES NOT ACQUIRE THE MUTEX
     *
     * @return bool
     */
    public function testLock(): bool;

    public function releaseLock(): MutexInterface;

    public function setResource(ResourceInterface $resource): MutexInterface;

    public function hasLock(): bool;
}
