<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete;

use Neighborhoods\Kojo\ServiceAbstract;

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