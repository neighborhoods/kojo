<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete;

use NHDS\Jobs\Data\Job\AbstractService;

class FailedScheduleLimitCheck extends AbstractService implements FailedScheduleLimitCheckInterface
{
    public function save(): FailedScheduleLimitCheckInterface
    {
        $this->_getJobStateService()->setJob($this->_getJob());
        $this->_getJobStateService()->requestCompleteFailedScheduleLimitCheck();
        $this->_getJobStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}