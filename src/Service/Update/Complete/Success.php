<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete;

class Success implements SuccessInterface
{
    public function save(): SuccessInterface
    {
        $this->getStateService()->setJob($this->getJob());
        $this->getStateService()->requestCompleteSuccess();
        $this->getStateService()->applyRequest();
        $this->getJob()->save();

        return $this;
    }
}