<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Work\Factory;

use NHDS\Jobs\Service\Update\Work\FactoryInterface;

trait AwareTrait
{
    public function setServiceUpdateWorkFactory(FactoryInterface $serviceUpdateWorkFactory)
    {
        $this->_create(FactoryInterface::class, $serviceUpdateWorkFactory);

        return $this;
    }

    protected function _getServiceUpdateWorkFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _unsetServiceUpdateWorkFactory()
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}