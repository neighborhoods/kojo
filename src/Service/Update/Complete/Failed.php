<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update\Complete;

use NHDS\Jobs\ServiceAbstract;

class Failed extends ServiceAbstract implements FailedInterface
{
    public function _save(): FailedInterface
    {
        $this->_getStateService()->setJob($this->_getJob());
        $this->_getStateService()->requestCompleteFailed();
        $this->_getStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}