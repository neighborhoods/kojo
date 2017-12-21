<?php

namespace NHDS\Jobs\Semaphore;

use NHDS\Jobs\Semaphore\Resource\OwnerInterface;

interface ResourceInterface
{
    public function setResourceName(string $resourceName): ResourceInterface;

    public function setResourcePath(string $resourcePath): ResourceInterface;

    public function setIsBlocking(bool $isBlocking): ResourceInterface;

    public function getResourceId(): string;

    public function getResourceName(): string;

    public function getResourcePath(): string;

    public function getIsBlocking(): bool;

    public function setMutex(MutexInterface $mutex): ResourceInterface;

    public function getMutex(): MutexInterface;

    public function setResourceOwner(OwnerInterface $resourceOwner): ResourceInterface;

    public function getResourceOwner(): OwnerInterface;
}