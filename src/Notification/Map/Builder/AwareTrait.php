<?php

namespace Neighborhoods\Kojo\Notification\Map\Builder;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotificationMapBuilder = null;

    public function setRETS1NotificationMapBuilder(\Neighborhoods\Kojo\Notification\Map\BuilderInterface $RETS1NotificationMapBuilder) : self
    {
        if ($this->hasRETS1NotificationMapBuilder()) {
            throw new \LogicException('RETS1NotificationMapBuilder is already set.');
        }
        $this->RETS1NotificationMapBuilder = $RETS1NotificationMapBuilder;

        return $this;
    }

    protected function getRETS1NotificationMapBuilder() : \Neighborhoods\Kojo\Notification\Map\BuilderInterface
    {
        if (!$this->hasRETS1NotificationMapBuilder()) {
            throw new \LogicException('RETS1NotificationMapBuilder is not set.');
        }

        return $this->RETS1NotificationMapBuilder;
    }

    protected function hasRETS1NotificationMapBuilder() : bool
    {
        return isset($this->RETS1NotificationMapBuilder);
    }

    protected function unsetRETS1NotificationMapBuilder() : self
    {
        if (!$this->hasRETS1NotificationMapBuilder()) {
            throw new \LogicException('RETS1NotificationMapBuilder is not set.');
        }
        unset($this->RETS1NotificationMapBuilder);

        return $this;
    }


}

