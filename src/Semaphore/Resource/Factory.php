<?php
declare(strict_types=1);

namespace NHDS\Jobs\Semaphore\Resource;

use NHDS\Jobs\Semaphore;
use NHDS\Jobs\Service\FactoryAbstract;
use NHDS\Toolkit\Data\Property\Strict;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Semaphore\AwareTrait;
    use Semaphore\Resource\AwareTrait;
    use Semaphore\Mutex\AwareTrait;
    use Semaphore\Resource\Owner\AwareTrait;
    use Strict\AwareTrait;

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
}