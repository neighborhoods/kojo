<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Cancelled;

use NHDS\Jobs\Data\Job\AbstractService;

class FailedLimitCheck extends AbstractService implements FailedLimitCheckInterface
{
    public function save(): FailedLimitCheckInterface
    {
        $this->_getJobStateService()->requestCancelledFailedLimitCheck();
        $this->_getJob()->save();

        return $this;
    }
}