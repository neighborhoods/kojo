<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore;

use Neighborhoods\Kojo\Exception;

abstract class MutexAbstract implements MutexInterface
{
    protected $isBlocking;
    protected $resource;

    public function setIsBlocking(bool $isBlocking): MutexInterface
    {
        if ($this->isBlocking === null) {
            $this->isBlocking = $isBlocking;
        }

        return $this;
    }

    protected function getIsBlocking(): bool
    {
        if ($this->isBlocking === null) {
            $this->isBlocking = $this->getResource()->getIsBlocking();
        }

        return $this->isBlocking;
    }

    public function setResource(ResourceInterface $resource): MutexInterface
    {
        if ($this->resource === null) {
            $this->resource = $resource;
        }else {
            throw new \LogicException('Resource is already set.');
        }

        return $this;
    }

    protected function getResource(): ResourceInterface
    {
        if ($this->resource === null) {
            throw new \LogicException('Resource is not set.');
        }

        return $this->resource;
    }
}