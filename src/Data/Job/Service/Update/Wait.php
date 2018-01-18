<?php

namespace NHDS\Jobs\Data\Job\Service\Update;

use NHDS\Jobs\Data\Job\ServiceAbstract;

class Wait extends ServiceAbstract implements WaitInterface
{
    public function _save(): WaitInterface
    {
        $this->_getJobStateService()->setJob($this->_getJob());
        $this->_getJobStateService()->requestWaitForWork();
        $this->_getJobStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}