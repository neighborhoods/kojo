<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore;

use Neighborhoods\Kojo\Semaphore\Resource\OwnerInterface;
use Neighborhoods\Kojo\SemaphoreInterface;

interface ResourceInterface
{
    public function setSemaphore(SemaphoreInterface $semaphore);

    public function testAndSetLock(): bool;

    public function hasLock(): bool;

    public function releaseLock(): ResourceInterface;

    public function setResourceName(string $resourceName): ResourceInterface;

    public function setResourcePath(string $resourcePath): ResourceInterface;

    public function setIsBlocking(bool $isBlocking): ResourceInterface;

    public function getResourceId(): string;

    public function getResourceName(): string;

    public function getResourcePath(): string;

    public function getIsBlocking(): bool;

    public function setMutex(MutexInterface $mutex): ResourceInterface;

    public function getMutex(): MutexInterface;

    public function setSemaphoreResourceOwner(OwnerInterface $resourceOwner);
}