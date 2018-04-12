<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore;

use Neighborhoods\Kojo\SemaphoreInterface;

trait AwareTrait
{
    public function setSemaphore(SemaphoreInterface $semaphore): self
    {
        $this->_create(SemaphoreInterface::class, $semaphore);

        return $this;
    }

    protected function _getSemaphore(): SemaphoreInterface
    {
        return $this->_read(SemaphoreInterface::class);
    }

    protected function _getSemaphoreClone(): SemaphoreInterface
    {
        return clone $this->_getSemaphore();
    }

    protected function _hasSemaphore(): bool
    {
        return $this->_exists(SemaphoreInterface::class);
    }

    protected function _unsetSemaphore(): self
    {
        $this->_delete(SemaphoreInterface::class);

        return $this;
    }
}