<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Cancelled\FailedLimitCheck\Factory;


use NHDS\Jobs\Data\Job\Service\Update\Cancelled\FailedLimitCheck\FactoryInterface;

trait AwareTrait
{
    public function setJobServiceUpdateCancelledFailedLimitCheckFactory(FactoryInterface $updateCancelledFailedLimitCheckFactory)
    {
        $this->_create(FactoryInterface::class, $updateCancelledFailedLimitCheckFactory);

        return $this;
    }

    protected function _getJobServiceUpdateCancelledFailedLimitCheckFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }
}