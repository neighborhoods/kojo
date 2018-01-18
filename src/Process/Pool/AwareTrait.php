<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\Process\PoolInterface;

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

    protected function _deleteProcessPool()
    {
        $this->_delete(PoolInterface::class);

        return $this;
    }
}