<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Retry\Factory;

use NHDS\Jobs\Service\Update\Retry\FactoryInterface;

trait AwareTrait
{
    public function setServiceUpdateRetryFactory(FactoryInterface $serviceUpdateRetryFactory)
    {
        $this->_create(FactoryInterface::class, $serviceUpdateRetryFactory);

        return $this;
    }

    protected function _getServiceUpdateRetryFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _unsetServiceUpdateRetryFactory()
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}