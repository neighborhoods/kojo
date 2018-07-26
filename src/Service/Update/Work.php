<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update;

class Work implements WorkInterface
{
    public function save(): WorkInterface
    {
        $this->getStateService()->setJob($this->getJob());
        $this->getStateService()->requestWork();
        $this->getStateService()->applyRequest();
        $this->getJob()->save();

        return $this;
    }
}