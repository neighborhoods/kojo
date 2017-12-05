<?php

namespace NHDS\Jobs\Semaphore\Mutex;

use NHDS\Jobs\Exception;
use NHDS\Jobs\Semaphore\ResourceInterface;

abstract class AbstractMutex implements MutexInterface
{
    use Exception\Runtime\Filesystem\AwareTrait;
    protected $_isBlocking;
    protected $_resource;

    public function setIsBlocking(bool $isBlocking): MutexInterface
    {
        if ($this->_isBlocking === null) {
            $this->_isBlocking = $isBlocking;
        }

        return $this;
    }

    protected function _getIsBlocking(): bool
    {
        if ($this->_isBlocking === null) {
            $this->_isBlocking = $this->_getResource()->getIsBlocking();
        }

        return $this->_isBlocking;
    }

    public function setResource(ResourceInterface $resource): MutexInterface
    {
        if ($this->_resource === null) {
            $this->_resource = $resource;
        }else {
            throw new \LogicException('Resource is already set.');
        }

        return $this;
    }

    protected function _getResource(): ResourceInterface
    {
        if ($this->_resource === null) {
            throw new \LogicException('Resource is not set.');
        }

        return $this->_resource;
    }
}