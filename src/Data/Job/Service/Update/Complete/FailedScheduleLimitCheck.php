<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete;

use NHDS\Jobs\Data\Job\ServiceAbstract;

class FailedScheduleLimitCheck extends ServiceAbstract implements FailedScheduleLimitCheckInterface
{
    public function _save(): FailedScheduleLimitCheckInterface
    {
        $this->_getJobStateService()->setJob($this->_getJob());
        $this->_getJobStateService()->requestCompleteFailedScheduleLimitCheck();
        $this->_getJobStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}