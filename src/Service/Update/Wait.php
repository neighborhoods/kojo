<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update;

use NHDS\Jobs\ServiceAbstract;

class Wait extends ServiceAbstract implements WaitInterface
{
    public function _save(): WaitInterface
    {
        $this->_getStateService()->setJob($this->_getJob());
        $this->_getStateService()->requestWaitForWork();
        $this->_getStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}