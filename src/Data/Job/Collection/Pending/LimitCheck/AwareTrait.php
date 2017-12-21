<?php

namespace NHDS\Jobs\Data\Job\Collection\Pending\LimitCheck;

use NHDS\Jobs\Data\Job\Collection\Pending\LimitCheckInterface;

trait AwareTrait
{
    public function setJobCollectionPendingLimitCheck(LimitCheckInterface $jobCollectionPendingLimitCheck)
    {
        $this->_create(LimitCheckInterface::class, $jobCollectionPendingLimitCheck);

        return $this;
    }

    protected function _getJobCollectionPendingLimitCheck(): LimitCheckInterface
    {
        return $this->_read(LimitCheckInterface::class);
    }

    protected function _getJobCollectionPendingLimitCheckClone(): LimitCheckInterface
    {
        return clone $this->_getJobCollectionPendingLimitCheck();
    }
}