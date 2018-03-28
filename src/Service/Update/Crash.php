<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update;

use Neighborhoods\Kojo\ServiceAbstract;

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