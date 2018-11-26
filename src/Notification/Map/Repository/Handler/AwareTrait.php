<?php

namespace Neighborhoods\Kojo\Notification\Map\Repository\Handler;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotificationMapRepositoryHandler = null;

    public function setRETS1NotificationMapRepositoryHandler(\Neighborhoods\Kojo\Notification\Map\Repository\HandlerInterface $RETS1NotificationMapRepositoryHandler) : self
    {
        if ($this->hasRETS1NotificationMapRepositoryHandler()) {
            throw new \LogicException('RETS1NotificationMapRepositoryHandler is already set.');
        }
        $this->RETS1NotificationMapRepositoryHandler = $RETS1NotificationMapRepositoryHandler;

        return $this;
    }

    protected function getRETS1NotificationMapRepositoryHandler() : \Neighborhoods\Kojo\Notification\Map\Repository\HandlerInterface
    {
        if (!$this->hasRETS1NotificationMapRepositoryHandler()) {
            throw new \LogicException('RETS1NotificationMapRepositoryHandler is not set.');
        }

        return $this->RETS1NotificationMapRepositoryHandler;
    }

    protected function hasRETS1NotificationMapRepositoryHandler() : bool
    {
        return isset($this->RETS1NotificationMapRepositoryHandler);
    }

    protected function unsetRETS1NotificationMapRepositoryHandler() : self
    {
        if (!$this->hasRETS1NotificationMapRepositoryHandler()) {
            throw new \LogicException('RETS1NotificationMapRepositoryHandler is not set.');
        }
        unset($this->RETS1NotificationMapRepositoryHandler);

        return $this;
    }


}

