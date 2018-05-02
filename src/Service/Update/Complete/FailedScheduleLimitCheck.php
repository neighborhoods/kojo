<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete;

use Neighborhoods\Kojo\ServiceAbstract;

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