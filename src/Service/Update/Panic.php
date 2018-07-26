<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update;

class Panic implements PanicInterface
{
    public function save(): PanicInterface
    {
        $this->getStateService()->setJob($this->getJob());
        $this->getStateService()->requestPanicked();
        $this->getStateService()->applyRequest();
        $this->getJob()->save();

        return $this;
    }
}