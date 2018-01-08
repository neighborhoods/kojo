<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\FailedScheduleLimitCheck;

use NHDS\Jobs\Data\Job\Service\Update\Complete\FailedScheduleLimitCheckInterface;

trait AwareTrait
{
    public function setUpdateCompleteFailedScheduleLimitCheck(
        FailedScheduleLimitCheckInterface $updateCompleteFailedScheduleLimitCheck
    ){
        $this->_create(FailedScheduleLimitCheckInterface::class, $updateCompleteFailedScheduleLimitCheck);

        return $this;
    }

    protected function _getUpdateCompleteFailedScheduleLimitCheck(): FailedScheduleLimitCheckInterface
    {
        return $this->_read(FailedScheduleLimitCheckInterface::class);
    }

    protected function _getUpdateCompleteFailedScheduleLimitCheckClone(): FailedScheduleLimitCheckInterface
    {
        return clone $this->_getUpdateCompleteFailedScheduleLimitCheck();
    }
}