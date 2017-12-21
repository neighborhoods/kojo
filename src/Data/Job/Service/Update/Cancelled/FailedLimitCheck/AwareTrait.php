<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Cancelled\FailedLimitCheck;

use NHDS\Jobs\Data\Job\Service\Update\Cancelled\FailedLimitCheckInterface;

trait AwareTrait
{
    public function setJobServiceUpdateCancelledFailedLimitCheck(FailedLimitCheckInterface $jobServiceUpdateFailedLimitCheck)
    {
        $this->_create(FailedLimitCheckInterface::class, $jobServiceUpdateFailedLimitCheck);

        return $this;
    }

    protected function _getJobServiceUpdateCancelledFailedLimitCheck(): FailedLimitCheckInterface
    {
        return $this->_read(FailedLimitCheckInterface::class);
    }

    protected function _getJobServiceUpdateCancelledFailedLimitCheckClone(): FailedLimitCheckInterface
    {
        return clone $this->_getJobServiceUpdateCancelledFailedLimitCheck();
    }
}