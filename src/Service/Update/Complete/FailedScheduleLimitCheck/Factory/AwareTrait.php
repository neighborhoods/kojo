<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Complete\FailedScheduleLimitCheck\Factory;

use NHDS\Jobs\Service\Update\Complete\FailedScheduleLimitCheck\FactoryInterface;

trait AwareTrait
{
    public function setServiceUpdateCompleteFailedScheduleLimitCheckFactory(
        FactoryInterface $serviceUpdateCompleteFailedScheduleLimitCheckFactory
    ){
        $this->_create(FactoryInterface::class, $serviceUpdateCompleteFailedScheduleLimitCheckFactory);

        return $this;
    }

    protected function _getServiceUpdateCompleteFailedScheduleLimitCheckFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _unsetServiceUpdateCompleteFailedScheduleLimitCheckFactory()
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}