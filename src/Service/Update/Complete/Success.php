<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Complete;

use NHDS\Jobs\ServiceAbstract;

class Success extends ServiceAbstract implements SuccessInterface
{
    public function _save(): SuccessInterface
    {
        $this->_getStateService()->setJob($this->_getJob());
        $this->_getStateService()->requestCompleteSuccess();
        $this->_getStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}