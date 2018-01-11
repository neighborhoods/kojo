<?php

namespace NHDS\Jobs\Semaphore\Resource;

use NHDS\Jobs\Semaphore;
use NHDS\Toolkit\Data\Property\Strict;

class Factory implements FactoryInterface
{
    use Semaphore\AwareTrait;
    use Semaphore\Resource\AwareTrait;
    use Semaphore\Mutex\AwareTrait;
    use Semaphore\Resource\Owner\AwareTrait;
    use Strict\AwareTrait;
    const PROP_FACTORY_NAME = 'factory_name';

    public function create(): Semaphore\ResourceInterface
    {
        $semaphoreResource = $this->_getSemaphoreResourceClone();
        $semaphoreResource->setMutex($this->_getMutexClone());
        $semaphoreResource->setSemaphore($this->_getSemaphore());
        if ($this->_hasSemaphoreResourceOwner()) {
            $semaphoreResource->setResourceOwner($this->_getSemaphoreResourceOwnerClone());
        }

        return $semaphoreResource;
    }

    public function setName(string $factoryName): FactoryInterface
    {
        $this->_create(self::PROP_FACTORY_NAME, $factoryName);

        return $this;
    }

    public function getName(): string
    {
        return $this->_read(self::PROP_FACTORY_NAME);
    }
}