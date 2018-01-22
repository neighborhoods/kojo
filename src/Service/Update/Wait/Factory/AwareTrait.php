<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Wait\Factory;

use NHDS\Jobs\Service\Update\Wait\FactoryInterface;

trait AwareTrait
{
    public function setServiceUpdateWaitFactory(FactoryInterface $serviceUpdateWaitFactory)
    {
        $this->_create(FactoryInterface::class, $serviceUpdateWaitFactory);

        return $this;
    }

    protected function _getServiceUpdateWaitFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _unsetServiceUpdateWaitFactory()
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}