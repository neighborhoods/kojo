<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore;

interface MutexInterface
{
    public function setIsBlocking(bool $isBlocking): MutexInterface;

    public function testAndSetLock(): bool;

    public function releaseLock(): MutexInterface;

    public function setResource(ResourceInterface $resource): MutexInterface;

    public function hasLock(): bool;
}