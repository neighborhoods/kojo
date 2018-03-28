<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update;

use Neighborhoods\Kojo\ServiceAbstract;

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