<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update;

use Neighborhoods\Kojo\ServiceAbstract;

class Work extends ServiceAbstract implements WorkInterface
{
    public function _save(): WorkInterface
    {
        $this->_getStateService()->setJob($this->_getJob());
        $this->_getStateService()->requestWork();
        $this->_getStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}