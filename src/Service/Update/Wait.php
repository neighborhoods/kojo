<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update;

class Wait implements WaitInterface
{
    public function save(): WaitInterface
    {
        $this->getStateService()->setJob($this->getJob());
        $this->getStateService()->requestWaitForWork();
        $this->getStateService()->applyRequest();
        $this->getJob()->save();

        return $this;
    }
}