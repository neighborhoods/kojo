<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Process\PoolInterface;

trait AwareTrait
{
    public function setProcessPool(PoolInterface $pool)
    {
        $this->_create(PoolInterface::class, $pool);

        return $this;
    }

    protected function _getProcessPool(): PoolInterface
    {
        return $this->_read(PoolInterface::class);
    }

    protected function _getProcessPoolClone(): PoolInterface
    {
        return clone $this->_getProcessPool();
    }

    protected function _hasProcessPool(): bool
    {
        return $this->_exists(PoolInterface::class);
    }

    protected function _unsetProcessPool()
    {
        $this->_delete(PoolInterface::class);

        return $this;
    }
}