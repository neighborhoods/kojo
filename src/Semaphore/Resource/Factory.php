<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource;

use Neighborhoods\Kojo\Semaphore;
use Neighborhoods\Kojo\Service\FactoryAbstract;
use Neighborhoods\Toolkit\Data\Property\Strict;

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