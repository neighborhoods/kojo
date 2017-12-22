<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Cancelled;

use NHDS\Jobs\Data\Job\AbstractService;

class FailedLimitCheck extends AbstractService implements FailedLimitCheckInterface
{
    public function save(): FailedLimitCheckInterface
    {
        $this->_getJobStateService()->setJob($this->_getJob());
        $this->_getJobStateService()->requestCancelledFailedLimitCheck();
        $this->_getJobStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}