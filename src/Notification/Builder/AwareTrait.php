<?php

namespace Neighborhoods\Kojo\Notification\Builder;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotificationBuilder = null;

    public function setRETS1NotificationBuilder(\Neighborhoods\Kojo\Notification\BuilderInterface $RETS1NotificationBuilder) : self
    {
        if ($this->hasRETS1NotificationBuilder()) {
            throw new \LogicException('RETS1NotificationBuilder is already set.');
        }
        $this->RETS1NotificationBuilder = $RETS1NotificationBuilder;

        return $this;
    }

    protected function getRETS1NotificationBuilder() : \Neighborhoods\Kojo\Notification\BuilderInterface
    {
        if (!$this->hasRETS1NotificationBuilder()) {
            throw new \LogicException('RETS1NotificationBuilder is not set.');
        }

        return $this->RETS1NotificationBuilder;
    }

    protected function hasRETS1NotificationBuilder() : bool
    {
        return isset($this->RETS1NotificationBuilder);
    }

    protected function unsetRETS1NotificationBuilder() : self
    {
        if (!$this->hasRETS1NotificationBuilder()) {
            throw new \LogicException('RETS1NotificationBuilder is not set.');
        }
        unset($this->RETS1NotificationBuilder);

        return $this;
    }


}

