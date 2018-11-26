<?php

namespace Neighborhoods\Kojo\Notification\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotificationFactory = null;

    public function setRETS1NotificationFactory(\Neighborhoods\Kojo\Notification\FactoryInterface $RETS1NotificationFactory) : self
    {
        if ($this->hasRETS1NotificationFactory()) {
            throw new \LogicException('RETS1NotificationFactory is already set.');
        }
        $this->RETS1NotificationFactory = $RETS1NotificationFactory;

        return $this;
    }

    protected function getRETS1NotificationFactory() : \Neighborhoods\Kojo\Notification\FactoryInterface
    {
        if (!$this->hasRETS1NotificationFactory()) {
            throw new \LogicException('RETS1NotificationFactory is not set.');
        }

        return $this->RETS1NotificationFactory;
    }

    protected function hasRETS1NotificationFactory() : bool
    {
        return isset($this->RETS1NotificationFactory);
    }

    protected function unsetRETS1NotificationFactory() : self
    {
        if (!$this->hasRETS1NotificationFactory()) {
            throw new \LogicException('RETS1NotificationFactory is not set.');
        }
        unset($this->RETS1NotificationFactory);

        return $this;
    }


}

