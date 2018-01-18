<?php

namespace NHDS\Jobs\Data\Job\Service\Update;

use NHDS\Jobs\Data\Job\ServiceAbstract;

class Hold extends ServiceAbstract implements HoldInterface
{
    public function _save(): HoldInterface
    {
        $this->_getJobStateService()->setJob($this->_getJob());
        $this->_getJobStateService()->requestHold();
        $this->_getJobStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}