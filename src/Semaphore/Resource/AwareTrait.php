<?php

namespace NHDS\Jobs\Semaphore\Resource;

use NHDS\Jobs\Semaphore\ResourceInterface;

trait AwareTrait
{
    protected $_semaphoreResources = [];

    public function addSemaphoreResource(string $resourceName, ResourceInterface $resource)
    {
        if (!isset($this->_semaphoreResources[$resourceName])) {
            $this->_semaphoreResources[$resourceName] = $resource;
        }else {
            throw new \LogicException('Semaphore resource "' . $resourceName . ' is already set.');
        }

        return $this;
    }

    protected function _getSemaphoreResource($resourceName): ResourceInterface
    {
        if (!isset($this->_semaphoreResources[$resourceName])) {
            throw new \LogicException('Semaphore resource "' . $resourceName . '" is not set.');
        }

        return $this->_semaphoreResources[$resourceName];
    }

    protected function _getSemaphoreResourceClone($resourceName): ResourceInterface
    {
        if (!isset($this->_semaphoreResources[$resourceName])) {
            throw new \LogicException('Semaphore resource "' . $resourceName . '" is not set.');
        }

        return clone $this->_semaphoreResources[$resourceName];
    }
}