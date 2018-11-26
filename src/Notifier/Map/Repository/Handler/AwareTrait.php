<?php

namespace Neighborhoods\Kojo\Notifier\Map\Repository\Handler;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotifierMapRepositoryHandler = null;

    public function setRETS1NotifierMapRepositoryHandler(\Neighborhoods\Kojo\Notifier\Map\Repository\HandlerInterface $RETS1NotifierMapRepositoryHandler) : self
    {
        if ($this->hasRETS1NotifierMapRepositoryHandler()) {
            throw new \LogicException('RETS1NotifierMapRepositoryHandler is already set.');
        }
        $this->RETS1NotifierMapRepositoryHandler = $RETS1NotifierMapRepositoryHandler;

        return $this;
    }

    protected function getRETS1NotifierMapRepositoryHandler() : \Neighborhoods\Kojo\Notifier\Map\Repository\HandlerInterface
    {
        if (!$this->hasRETS1NotifierMapRepositoryHandler()) {
            throw new \LogicException('RETS1NotifierMapRepositoryHandler is not set.');
        }

        return $this->RETS1NotifierMapRepositoryHandler;
    }

    protected function hasRETS1NotifierMapRepositoryHandler() : bool
    {
        return isset($this->RETS1NotifierMapRepositoryHandler);
    }

    protected function unsetRETS1NotifierMapRepositoryHandler() : self
    {
        if (!$this->hasRETS1NotifierMapRepositoryHandler()) {
            throw new \LogicException('RETS1NotifierMapRepositoryHandler is not set.');
        }
        unset($this->RETS1NotifierMapRepositoryHandler);

        return $this;
    }


}

