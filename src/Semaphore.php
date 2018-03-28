<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Semaphore\ResourceInterface;

class Semaphore implements SemaphoreInterface
{
    protected $_resources  = [];
    protected $_lockCounts = [];

    public function testAndSetLock(ResourceInterface $resource): bool
    {
        $resourceId = $resource->getResourceId();
        if ($this->_hasResource($resourceId)) {
            $this->_incrementLockCount($resourceId);
        }else {
            $this->_resources[$resourceId] = $resource;
            if ($this->_getResource($resourceId)->getMutex()->testAndSetLock() === true) {
                $this->_incrementLockCount($resourceId);
            }else {
                $this->_unsetResource($resourceId);
            }
        }

        return $this->hasLock($resource);
    }

    public function releaseLock(ResourceInterface $resource): SemaphoreInterface
    {
        $resourceId = $resource->getResourceId();
        if ($this->_getLockCount($resourceId) === 1) {
            $this->_getResource($resourceId)->getMutex()->releaseLock();
            $this->_unsetLockCount($resourceId);
            $this->_unsetResource($resourceId);
        }else {
            $this->_decrementLockCount($resourceId);
        }

        return $this;
    }

    public function hasLock(ResourceInterface $resource): bool
    {
        $resourceId = $resource->getResourceId();

        return ($this->_hasResource($resourceId) && $this->_getResource($resourceId)->getMutex()->hasLock());
    }

    protected function _unsetLockCount(string $resourceId): Semaphore
    {
        if ($this->_lockCounts[$resourceId] !== 1) {
            throw new \LogicException('Lock count is not 1.');
        }
        unset($this->_lockCounts[$resourceId]);

        return $this;
    }

    protected function _unsetResource(string $resourceId): Semaphore
    {
        if (!$this->_hasResource($resourceId)) {
            throw new \LogicException('Resource is not set.');
        }
        unset($this->_resources[$resourceId]);

        return $this;
    }

    protected function _getResource(string $resourceId): ResourceInterface
    {
        if (!$this->_hasResource($resourceId)) {
            throw new \LogicException('Resource is not set.');
        }

        return $this->_resources[$resourceId];
    }

    protected function _hasResource(string $resourceId): bool
    {
        return isset($this->_resources[$resourceId]);
    }

    protected function _getLockCount(string $resourceId): int
    {
        if (!$this->_hasLockCount($resourceId)) {
            throw new \LogicException('Lock count is not set.');
        }

        return $this->_lockCounts[$resourceId];
    }

    protected function _hasLockCount(string $resourceId): bool
    {
        return isset($this->_lockCounts[$resourceId]);
    }

    protected function _incrementLockCount(string $resourceId): SemaphoreInterface
    {
        if ($this->_hasResource($resourceId)) {
            if ($this->_hasLockCount($resourceId)) {
                ++$this->_lockCounts[$resourceId];
            }else {
                $this->_lockCounts[$resourceId] = 1;
            }
        }else {
            throw new \LogicException('Resource is not set.');
        }

        return $this;
    }

    protected function _decrementLockCount(string $resourceId): SemaphoreInterface
    {
        if ($this->_hasResource($resourceId)) {
            if ($this->_getLockCount($resourceId) > 1) {
                --$this->_lockCounts[$resourceId];
            }else {
                throw new \LogicException('Lock count is less than one.');
            }
        }else {
            throw new \LogicException('Resource is not set.');
        }

        return $this;
    }
}