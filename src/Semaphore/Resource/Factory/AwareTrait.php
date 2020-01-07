<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Factory;

use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Semaphore\Resource\FactoryInterface;
use Neighborhoods\Kojo\Semaphore;
use Neighborhoods\Kojo\Semaphore\ResourceInterface;

trait AwareTrait
{
    protected $_semaphoreResourceFactories = [];
    protected $_cachedSemaphoreResources   = [];

    public function addSemaphoreResourceFactory(FactoryInterface $semaphoreResourceFactory)
    {
        if (!isset($this->_semaphoreResourceFactories[$semaphoreResourceFactory->getName()])) {
            $this->_semaphoreResourceFactories[$semaphoreResourceFactory->getName()] = $semaphoreResourceFactory;
        }else {
            $factoryName = $semaphoreResourceFactory->getName();
            throw new \LogicException('Semaphore resource factory with name "' . $factoryName . '" is already set.');
        }

        return $this;
    }

    protected function _getSemaphoreResourceFactory(string $factoryName): FactoryInterface
    {
        if (!isset($this->_semaphoreResourceFactories[$factoryName])) {
            throw new \LogicException('Semaphore resource factory with name "' . $factoryName . '" is not set.');
        }

        return $this->_semaphoreResourceFactories[$factoryName];
    }

    protected function _getSemaphoreResource(string $semaphoreResourceFactoryName): ResourceInterface
    {
        if (!isset($this->_cachedSemaphoreResources[$semaphoreResourceFactoryName])) {
            $semaphoreResourceFactory = $this->_getSemaphoreResourceFactory($semaphoreResourceFactoryName);
            $this->_cachedSemaphoreResources[$semaphoreResourceFactoryName] = $semaphoreResourceFactory->create();
        }

        return $this->_cachedSemaphoreResources[$semaphoreResourceFactoryName];
    }

    protected function _getNewSemaphoreResource(string $semaphoreResourceFactoryName): ResourceInterface
    {
        return $this->_getSemaphoreResourceFactory($semaphoreResourceFactoryName)->create();
    }

    protected function _getNewJobOwnerResource(JobInterface $job): ResourceInterface
    {
        $jobSemaphoreResource = $this->_getSemaphoreResourceFactory('job')->create();
        $resourceOwner = $jobSemaphoreResource->getResourceOwner();
        if ($resourceOwner instanceof Semaphore\Resource\Owner\JobInterface) {
            $resourceOwner->setJob($job);
        }else {
            throw new \UnexpectedValueException('Resource owner is an unexpected type.');
        }

        return $jobSemaphoreResource;
    }
}
