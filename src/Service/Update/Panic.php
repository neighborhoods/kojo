<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update;

use NHDS\Jobs\ServiceAbstract;

class Panic extends ServiceAbstract implements PanicInterface
{
    public function _save(): PanicInterface
    {
        $this->_getStateService()->setJob($this->_getJob());
        $this->_getStateService()->requestPanicked();
        $this->_getStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}