<?php

namespace Neighborhoods\Kojo\Notification;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1Notification = null;

    public function setRETS1Notification(\Neighborhoods\Kojo\NotificationInterface $RETS1Notification) : self
    {
        if ($this->hasRETS1Notification()) {
            throw new \LogicException('RETS1Notification is already set.');
        }
        $this->RETS1Notification = $RETS1Notification;

        return $this;
    }

    protected function getRETS1Notification() : \Neighborhoods\Kojo\NotificationInterface
    {
        if (!$this->hasRETS1Notification()) {
            throw new \LogicException('RETS1Notification is not set.');
        }

        return $this->RETS1Notification;
    }

    protected function hasRETS1Notification() : bool
    {
        return isset($this->RETS1Notification);
    }

    protected function unsetRETS1Notification() : self
    {
        if (!$this->hasRETS1Notification()) {
            throw new \LogicException('RETS1Notification is not set.');
        }
        unset($this->RETS1Notification);

        return $this;
    }


}

