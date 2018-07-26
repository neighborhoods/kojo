<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete;

use Neighborhoods\Kojo\ServiceAbstract;

class FailedScheduleLimitCheck implements FailedScheduleLimitCheckInterface
{
    public function _save(): FailedScheduleLimitCheckInterface
    {
        $this->getStateService()->setJob($this->getJob());
        $this->getStateService()->requestCompleteFailedScheduleLimitCheck();
        $this->getStateService()->applyRequest();
        $this->getJob()->save();

        return $this;
    }
}