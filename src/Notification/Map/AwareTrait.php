<?php

namespace Neighborhoods\Kojo\Notification\Map;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotificationMap = null;

    public function setRETS1NotificationMap(\Neighborhoods\Kojo\Notification\MapInterface $RETS1NotificationMap) : self
    {
        if ($this->hasRETS1NotificationMap()) {
            throw new \LogicException('RETS1NotificationMap is already set.');
        }
        $this->RETS1NotificationMap = $RETS1NotificationMap;

        return $this;
    }

    protected function getRETS1NotificationMap() : \Neighborhoods\Kojo\Notification\MapInterface
    {
        if (!$this->hasRETS1NotificationMap()) {
            throw new \LogicException('RETS1NotificationMap is not set.');
        }

        return $this->RETS1NotificationMap;
    }

    protected function hasRETS1NotificationMap() : bool
    {
        return isset($this->RETS1NotificationMap);
    }

    protected function unsetRETS1NotificationMap() : self
    {
        if (!$this->hasRETS1NotificationMap()) {
            throw new \LogicException('RETS1NotificationMap is not set.');
        }
        unset($this->RETS1NotificationMap);

        return $this;
    }


}

