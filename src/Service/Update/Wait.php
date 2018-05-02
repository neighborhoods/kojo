<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update;

use Neighborhoods\Kojo\ServiceAbstract;

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