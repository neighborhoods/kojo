<?php

namespace NHDS\Jobs\Semaphore;

use NHDS\Jobs\Semaphore\Mutex\MutexInterface;

class Resource implements ResourceInterface
{
    protected $_mutex;
    protected $_resourceName;
    protected $_resourcePath;
    protected $_isBlocking;
    protected $_resourceId;

    public function setResourceName(string $resourceName): ResourceInterface
    {
        if ($this->_resourceName === null) {
            $this->_resourceName = $resourceName;
        }else {
            throw new \LogicException('Resource name is already set.');
        }

        return $this;
    }

    public function getResourceName(): string
    {
        if ($this->_resourceName === null) {
            throw new \LogicException('Resource name is not set.');
        }

        return $this->_resourceName;
    }

    public function setResourcePath(string $resourcePath): ResourceInterface
    {
        if ($this->_resourcePath === null) {
            $this->_resourcePath = $resourcePath;
        }else {
            throw new \LogicException('Resource path is already set.');
        }

        return $this;
    }

    public function getResourcePath(): string
    {
        if ($this->_resourcePath === null) {
            throw new \LogicException('Resource path is not set.');
        }

        return $this->_resourcePath;
    }

    public function setIsBlocking(bool $isBlocking): ResourceInterface
    {
        if ($this->_isBlocking === null) {
            $this->_isBlocking = $isBlocking;
        }else {
            throw new \LogicException('Is blocking is already set.');
        }

        return $this;
    }

    public function getIsBlocking(): bool
    {
        if ($this->_isBlocking === null) {
            throw new \LogicException('Is blocking is not set.');
        }

        return $this->_isBlocking;
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