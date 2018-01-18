<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Pool\Factory;

use NHDS\Jobs\Process\Pool\FactoryInterface;

trait AwareTrait
{
    public function setProcessPoolFactory(FactoryInterface $pool)
    {
        $this->_create(FactoryInterface::class, $pool);

        return $this;
    }

    protected function _getProcessPoolFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _getProcessPoolFactoryClone(): FactoryInterface
    {
        return clone $this->_getProcessPool();
    }

    protected function _hasProcessPoolFactory(): bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _deleteProcessPoolFactory()
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}