<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\Failed\Factory;

use NHDS\Jobs\Data\Job\Service\Update\Complete\Failed\FactoryInterface;

trait AwareTrait
{
    public function setUpdateCompleteFailedFactory(FactoryInterface $updateCompleteFailedFactory)
    {
        $this->_create(FactoryInterface::class, $updateCompleteFailedFactory);

        return $this;
    }

    protected function _getUpdateCompleteFailedFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }
}