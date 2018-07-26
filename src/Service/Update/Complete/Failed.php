<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete;

class Failed implements FailedInterface
{
    public function save(): FailedInterface
    {
        $this->getStateService()->setJob($this->getJob());
        $this->getStateService()->requestCompleteFailed();
        $this->getStateService()->applyRequest();
        $this->getJob()->save();

        return $this;
    }
}