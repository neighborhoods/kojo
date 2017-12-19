<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Cancelled\FailedLimitCheck;

use NHDS\Jobs\Data\Job\Service\Update\Cancelled\FailedLimitCheckInterface;

trait AwareTrait
{
    public function setJobServiceUpdateFailedLimitCheck(FailedLimitCheckInterface $jobServiceUpdateFailedLimitCheck)
    {
        $this->_create(FailedLimitCheckInterface::class, $jobServiceUpdateFailedLimitCheck);

        return $this;
    }

    protected function _getJobServiceUpdateFailedLimitCheck(): FailedLimitCheckInterface
    {
        return $this->_read(FailedLimitCheckInterface::class);
    }

    protected function _getJobServiceUpdateFailedLimitCheckClone(): FailedLimitCheckInterface
    {
        return clone $this->_getJobServiceUpdateFailedLimitCheck();
    }
}