<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Semaphore\ResourceInterface;

class Semaphore implements SemaphoreInterface
{
    protected $resources  = [];
    protected $lockCounts = [];

    public function testAndSetLock(ResourceInterface $resource): bool
    {
        $resourceId = $resource->getResourceId();
        if ($this->hasResource($resourceId)) {
            $this->incrementLockCount($resourceId);
        }else {
            $this->resources[$resourceId] = $resource;
            if ($this->getResource($resourceId)->getMutex()->testAndSetLock() === true) {
                $this->incrementLockCount($resourceId);
            }else {
                $this->unsetResource($resourceId);
            }
        }

        return $this->hasLock($resource);
    }

    public function releaseLock(ResourceInterface $resource): SemaphoreInterface
    {
        $resourceId = $resource->getResourceId();
        if ($this->getLockCount($resourceId) === 1) {
            $this->getResource($resourceId)->getMutex()->releaseLock();
            $this->unsetLockCount($resourceId);
            $this->unsetResource($resourceId);
        }else {
            $this->decrementLockCount($resourceId);
        }

        return $this;
    }

    public function hasLock(ResourceInterface $resource): bool
    {
        $resourceId = $resource->getResourceId();

        return ($this->hasResource($resourceId) && $this->getResource($resourceId)->getMutex()->hasLock());
    }

    protected function unsetLockCount(string $resourceId): Semaphore
    {
        if ($this->lockCounts[$resourceId] !== 1) {
            throw new \LogicException('Lock count is not 1.');
        }
        unset($this->lockCounts[$resourceId]);

        return $this;
    }

    protected function unsetResource(string $resourceId): Semaphore
    {
        if (!$this->hasResource($resourceId)) {
            throw new \LogicException('Resource is not set.');
        }
        unset($this->resources[$resourceId]);

        return $this;
    }

    protected function getResource(string $resourceId): ResourceInterface
    {
        if (!$this->hasResource($resourceId)) {
            throw new \LogicException('Resource is not set.');
        }

        return $this->resources[$resourceId];
    }

    protected function hasResource(string $resourceId): bool
    {
        return isset($this->resources[$resourceId]);
    }

    protected function getLockCount(string $resourceId): int
    {
        if (!$this->hasLockCount($resourceId)) {
            throw new \LogicException('Lock count is not set.');
        }

        return $this->lockCounts[$resourceId];
    }

    protected function hasLockCount(string $resourceId): bool
    {
        return isset($this->lockCounts[$resourceId]);
    }

    protected function incrementLockCount(string $resourceId): SemaphoreInterface
    {
        if ($this->hasResource($resourceId)) {
            if ($this->hasLockCount($resourceId)) {
                ++$this->lockCounts[$resourceId];
            }else {
                $this->lockCounts[$resourceId] = 1;
            }
        }else {
            throw new \LogicException('Resource is not set.');
        }

        return $this;
    }

    protected function decrementLockCount(string $resourceId): SemaphoreInterface
    {
        if ($this->hasResource($resourceId)) {
            if ($this->getLockCount($resourceId) > 1) {
                --$this->lockCounts[$resourceId];
            }else {
                throw new \LogicException('Lock count is less than one.');
            }
        }else {
            throw new \LogicException('Resource is not set.');
        }

        return $this;
    }
}