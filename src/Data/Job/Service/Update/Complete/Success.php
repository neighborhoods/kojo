<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete;

use NHDS\Jobs\Data\Job\ServiceAbstract;

class Success extends ServiceAbstract implements SuccessInterface
{
    public function _save(): SuccessInterface
    {
        $this->_getJobStateService()->setJob($this->_getJob());
        $this->_getJobStateService()->requestCompleteSuccess();
        $this->_getJobStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}