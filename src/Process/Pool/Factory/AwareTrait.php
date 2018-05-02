<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Factory;

use Neighborhoods\Kojo\Process\Pool\FactoryInterface;

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

    protected function _hasProcessPoolFactory(): bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _unsetProcessPoolFactory()
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}