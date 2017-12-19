<?php

namespace NHDS\Jobs\Data\Job\Collection\Pending\LimitCheck;

use NHDS\Jobs\Data\Job\Collection\Pending\LimitCheckInterface;

trait AwareTrait
{
    public function setJobCollectionLimitCheck(LimitCheckInterface $jobCollectionLimitCheck)
    {
        $this->_create(LimitCheckInterface::class, $jobCollectionLimitCheck);

        return $this;
    }

    protected function _getJobCollectionLimitCheck(): LimitCheckInterface
    {
        return $this->_read(LimitCheckInterface::class);
    }

    protected function _getJobCollectionLimitCheckClone(): LimitCheckInterface
    {
        return clone $this->_getJobCollectionLimitCheck();
    }
}