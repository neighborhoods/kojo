<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update;

use Neighborhoods\Kojo\ServiceInterface;
use Neighborhoods\Kojo\State;
use Neighborhoods\Kojo;

class Crash implements CrashInterface
{
    use State\Service\AwareTrait;
    use Kojo\Job\AwareTrait;

    protected $isSaved = false;

    public function save(): ServiceInterface
    {
        if ($this->isSaved === false) {
            $this->getStateService()->setJob($this->getJob());
            $this->getStateService()->requestCrashed();
            $this->getStateService()->applyRequest();
            $this->getJob()->save();
            $this->isSaved = true;
        } else {
            throw new \LogicException('Crash is already saved.');
        }


        return $this;
    }
}