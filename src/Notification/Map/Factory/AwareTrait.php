<?php

namespace Neighborhoods\Kojo\Notification\Map\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotificationMapFactory = null;

    public function setRETS1NotificationMapFactory(\Neighborhoods\Kojo\Notification\Map\FactoryInterface $RETS1NotificationMapFactory) : self
    {
        if ($this->hasRETS1NotificationMapFactory()) {
            throw new \LogicException('RETS1NotificationMapFactory is already set.');
        }
        $this->RETS1NotificationMapFactory = $RETS1NotificationMapFactory;

        return $this;
    }

    protected function getRETS1NotificationMapFactory() : \Neighborhoods\Kojo\Notification\Map\FactoryInterface
    {
        if (!$this->hasRETS1NotificationMapFactory()) {
            throw new \LogicException('RETS1NotificationMapFactory is not set.');
        }

        return $this->RETS1NotificationMapFactory;
    }

    protected function hasRETS1NotificationMapFactory() : bool
    {
        return isset($this->RETS1NotificationMapFactory);
    }

    protected function unsetRETS1NotificationMapFactory() : self
    {
        if (!$this->hasRETS1NotificationMapFactory()) {
            throw new \LogicException('RETS1NotificationMapFactory is not set.');
        }
        unset($this->RETS1NotificationMapFactory);

        return $this;
    }


}

