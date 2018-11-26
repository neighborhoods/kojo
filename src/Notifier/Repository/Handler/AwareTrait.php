<?php

namespace Neighborhoods\Kojo\Notifier\Repository\Handler;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotifierRepositoryHandler = null;

    public function setRETS1NotifierRepositoryHandler(\Neighborhoods\Kojo\Notifier\Repository\HandlerInterface $RETS1NotifierRepositoryHandler) : self
    {
        if ($this->hasRETS1NotifierRepositoryHandler()) {
            throw new \LogicException('RETS1NotifierRepositoryHandler is already set.');
        }
        $this->RETS1NotifierRepositoryHandler = $RETS1NotifierRepositoryHandler;

        return $this;
    }

    protected function getRETS1NotifierRepositoryHandler() : \Neighborhoods\Kojo\Notifier\Repository\HandlerInterface
    {
        if (!$this->hasRETS1NotifierRepositoryHandler()) {
            throw new \LogicException('RETS1NotifierRepositoryHandler is not set.');
        }

        return $this->RETS1NotifierRepositoryHandler;
    }

    protected function hasRETS1NotifierRepositoryHandler() : bool
    {
        return isset($this->RETS1NotifierRepositoryHandler);
    }

    protected function unsetRETS1NotifierRepositoryHandler() : self
    {
        if (!$this->hasRETS1NotifierRepositoryHandler()) {
            throw new \LogicException('RETS1NotifierRepositoryHandler is not set.');
        }
        unset($this->RETS1NotifierRepositoryHandler);

        return $this;
    }


}

