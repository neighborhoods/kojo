<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\FailedScheduleLimitCheck\Factory;

use NHDS\Jobs\Data\Job\Service\Update\Complete\FailedScheduleLimitCheck\FactoryInterface;

trait AwareTrait
{
    public function setUpdateCompleteFailedScheduleLimitCheckFactory(
        FactoryInterface $updateCompleteFailedScheduleLimitCheckFactory
    ){
        $this->_create(FactoryInterface::class, $updateCompleteFailedScheduleLimitCheckFactory);

        return $this;
    }

    protected function _getUpdateCompleteFailedScheduleLimitCheckFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }
}