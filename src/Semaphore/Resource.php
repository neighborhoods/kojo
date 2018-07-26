<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore;

use Neighborhoods\Kojo\Semaphore;

class Resource implements ResourceInterface
{
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Owner\AwareTrait;
    protected $mutex;
    protected $resourceId;
    protected $resourceName;
    protected $resourcePath;
    protected $isBlocking;

    public function testAndSetLock(): bool
    {
        return $this->getSemaphore()->testAndSetLock($this);
    }

    public function releaseLock(): ResourceInterface
    {
        $this->getSemaphore()->releaseLock($this);

        return $this;
    }

    public function hasLock(): bool
    {
        return $this->getSemaphore()->hasLock($this);
    }

    public function setResourceName(string $resourceName): ResourceInterface
    {
        if ($this->resourceName === null) {
            $this->resourceName = $resourceName;
        } else {
            throw new \LogicException('Resource name is already set.');
        }

        return $this;
    }

    public function getResourceName(): string
    {
        if (!$this->resourceName === null) {
            if ($this->hasSemaphoreResourceOwner()) {
                $this->resourceName = $this->getSemaphoreResourceOwner()->getResourceName();
            } else {
                throw new \LogicException('Resource name is not set.');
            }
        }

        return $this->resourceName;
    }

    public function setResourcePath(string $resourcePath): ResourceInterface
    {
        if ($this->resourcePath === null) {
            $this->resourcePath = $resourcePath;
        }

        return $this;
    }

    public function getResourcePath(): string
    {
        if (!$this->resourcePath) {
            if ($this->hasSemaphoreResourceOwner()) {
                $this->resourcePath = $this->getSemaphoreResourceOwner()->getResourcePath();
            } else {
                throw new \LogicException('Resource path is not set.');
            }
        }

        return $this->resourcePath;
    }

    public function setIsBlocking(bool $isBlocking): ResourceInterface
    {
        if ($this->isBlocking === null) {
            $this->isBlocking = $isBlocking;
        }

        return $this;
    }

    public function getIsBlocking(): bool
    {
        if (!$this->isBlocking === null) {
            if ($this->hasSemaphoreResourceOwner()) {
                $this->isBlocking = $this->getSemaphoreResourceOwner()->getIsBlocking();
            } else {
                throw new \LogicException('Is blocking is not set.');
            }
        }

        return $this->isBlocking;
    }

    public function getResourceId(): string
    {
        if ($this->resourceId === null) {
            $this->resourceId = md5($this->getResourcePath() . $this->getResourceName());
        }

        return $this->resourceId;
    }

    public function setMutex(MutexInterface $mutex): ResourceInterface
    {
        if ($this->mutex === null) {
            $mutex->setResource($this);
            $this->mutex = $mutex;
        } else {
            throw new \LogicException('Mutex is already set.');
        }

        return $this;
    }

    public function getMutex(): MutexInterface
    {
        if ($this->mutex === null) {
            throw new \LogicException('Mutex is not set');
        }

        return $this->mutex;
    }
}