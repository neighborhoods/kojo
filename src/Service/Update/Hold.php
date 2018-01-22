<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update;

use NHDS\Jobs\ServiceAbstract;

class Hold extends ServiceAbstract implements HoldInterface
{
    public function _save(): HoldInterface
    {
        $this->_getStateService()->setJob($this->_getJob());
        $this->_getStateService()->requestHold();
        $this->_getStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}