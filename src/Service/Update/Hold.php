<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update;

class Hold implements HoldInterface
{
    public function _save(): HoldInterface
    {
        $this->getStateService()->setJob($this->getJob());
        $this->getStateService()->requestHold();
        $this->getStateService()->applyRequest();
        $this->getJob()->save();

        return $this;
    }
}