<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Owner;

use Neighborhoods\Kojo\Semaphore\Resource\OwnerInterface;

trait AwareTrait
{
    public function setSemaphoreResourceOwner(OwnerInterface $semaphoreResourceOwner)
    {
        $this->_create(OwnerInterface::class, $semaphoreResourceOwner);

        return $this;
    }

    protected function _hasSemaphoreResourceOwner(): bool
    {
        return $this->_exists(OwnerInterface::class);
    }

    protected function _getSemaphoreResourceOwner(): OwnerInterface
    {
        return $this->_read(OwnerInterface::class);
    }

    protected function _getSemaphoreResourceOwnerClone(): OwnerInterface
    {
        return clone $this->_getSemaphoreResourceOwner();
    }
}