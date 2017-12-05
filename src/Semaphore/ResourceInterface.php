<?php

namespace NHDS\Jobs\Semaphore;

use NHDS\Jobs\Semaphore\Mutex\MutexInterface;

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
}