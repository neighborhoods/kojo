<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update;

use NHDS\Jobs\ServiceAbstract;

class Crash extends ServiceAbstract implements CrashInterface
{
    public function _save(): CrashInterface
    {
        $this->_getStateService()->setJob($this->_getJob());
        $this->_getStateService()->requestCrashed();
        $this->_getStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}