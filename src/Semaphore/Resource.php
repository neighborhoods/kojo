<?php

namespace NHDS\Jobs\Semaphore;

use NHDS\Jobs\Semaphore\Resource\OwnerInterface;
use NHDS\Jobs\SemaphoreInterface;
use NHDS\Toolkit\Data\Property\Crud;

class Resource implements ResourceInterface
{
    use Crud\AwareTrait;
    const PROP_RESOURCE_OWNER = 'resource_owner';
    const PROP_RESOURCE_NAME  = 'resource_name';
    const PROP_RESOURCE_PATH  = 'resource_path';
    const PROP_IS_BLOCKING    = 'is_blocking';
    protected $_mutex;
    protected $_resourceId;

    public function setSemaphore(SemaphoreInterface $semaphore): ResourceInterface
    {
        $this->_create(SemaphoreInterface::class, $semaphore);

        return $this;
    }

    protected function _getSemaphore(): SemaphoreInterface
    {
        return $this->_read(SemaphoreInterface::class);
    }

    public function testAndSetLock(): bool
    {
        return $this->_getSemaphore()->testAndSetLock($this);
    }

    public function releaseLock(): ResourceInterface
    {
        $this->_getSemaphore()->releaseLock($this);

        return $this;
    }

    public function hasLock(): bool
    {
        return $this->_getSemaphore()->hasLock($this);
    }

    public function setResourceOwner(OwnerInterface $resourceOwner): ResourceInterface
    {
        $this->_create(self::PROP_RESOURCE_OWNER, $resourceOwner);

        return $this;
    }

    public function getResourceOwner(): OwnerInterface
    {
        return $this->_read(self::PROP_RESOURCE_OWNER);
    }

    public function setResourceName(string $resourceName): ResourceInterface
    {
        $this->_create(self::PROP_RESOURCE_NAME, $resourceName);

        return $this;
    }

    public function getResourceName(): string
    {
        if (!$this->_exists(self::PROP_RESOURCE_NAME)) {
            if ($this->_exists(self::PROP_RESOURCE_OWNER)) {
                $this->_create(self::PROP_RESOURCE_NAME, $this->getResourceOwner()->getResourceName());
            }else {
                throw new \LogicException('Resource name is not set.');
            }
        }

        return $this->_read(self::PROP_RESOURCE_NAME);
    }

    public function setResourcePath(string $resourcePath): ResourceInterface
    {
        $this->_create(self::PROP_RESOURCE_PATH, $resourcePath);

        return $this;
    }

    public function getResourcePath(): string
    {
        if (!$this->_exists(self::PROP_RESOURCE_PATH)) {
            if ($this->_exists(self::PROP_RESOURCE_OWNER)) {
                $this->_create(self::PROP_RESOURCE_PATH, $this->getResourceOwner()->getResourcePath());
            }else {
                throw new \LogicException('Resource path is not set.');
            }
        }

        return $this->_read(self::PROP_RESOURCE_PATH);
    }

    public function setIsBlocking(bool $isBlocking): ResourceInterface
    {
        $this->_create(self::PROP_IS_BLOCKING, $isBlocking);

        return $this;
    }

    public function getIsBlocking(): bool
    {
        if (!$this->_exists(self::PROP_IS_BLOCKING)) {
            if ($this->_exists(self::PROP_RESOURCE_OWNER)) {
                $this->_create(self::PROP_IS_BLOCKING, $this->getResourceOwner()->getIsBlocking());
            }else {
                throw new \LogicException('Is blocking is not set.');
            }
        }

        return $this->_read(self::PROP_IS_BLOCKING);
    }

    public function getResourceId(): string
    {
        if ($this->_resourceId === null) {
            $this->_resourceId = md5($this->getResourcePath() . $this->getResourceName());
        }

        return $this->_resourceId;
    }

    public function setMutex(MutexInterface $mutex): ResourceInterface
    {
        if ($this->_mutex === null) {
            $mutex->setResource($this);
            $this->_mutex = $mutex;
        }else {
            throw new \LogicException('Mutex is already set.');
        }

        return $this;
    }

    public function getMutex(): MutexInterface
    {
        if ($this->_mutex === null) {
            throw new \LogicException('Mutex is not set');
        }

        return $this->_mutex;
    }
}