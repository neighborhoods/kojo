<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete;

use NHDS\Jobs\Data\Job\ServiceAbstract;

class Failed extends ServiceAbstract implements FailedInterface
{
    public function save(): FailedInterface
    {
        $this->_getJobStateService()->setJob($this->_getJob());
        $this->_getJobStateService()->requestCompleteFailed();
        $this->_getJobStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}