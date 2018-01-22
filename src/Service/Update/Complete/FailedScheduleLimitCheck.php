<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Complete;

use NHDS\Jobs\ServiceAbstract;

class FailedScheduleLimitCheck extends ServiceAbstract implements FailedScheduleLimitCheckInterface
{
    public function _save(): FailedScheduleLimitCheckInterface
    {
        $this->_getStateService()->setJob($this->_getJob());
        $this->_getStateService()->requestCompleteFailedScheduleLimitCheck();
        $this->_getStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}