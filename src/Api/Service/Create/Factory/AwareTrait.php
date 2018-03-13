<?php
declare(strict_types=1);

namespace NHDS\Jobs\Api\Service\Create\Factory;

use NHDS\Jobs\Api\Service\Create\FactoryInterface;

trait AwareTrait
{
    public function setServiceCreateFactory(FactoryInterface $updateCrashFactory)
    {
        $this->_create(FactoryInterface::class, $updateCrashFactory);

        return $this;
    }

    protected function _getServiceCreateFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _hasServiceCreateFactory(): bool
    {
        return $this->_exist(FactoryInterface::class);
    }

    protected function _unsetServiceCreateFactory(): self
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}