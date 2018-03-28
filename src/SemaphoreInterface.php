<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Semaphore\ResourceInterface;

interface SemaphoreInterface
{
    public function testAndSetLock(ResourceInterface $resource): bool;

    public function releaseLock(ResourceInterface $resource): SemaphoreInterface;

    public function hasLock(ResourceInterface $resource): bool;
}