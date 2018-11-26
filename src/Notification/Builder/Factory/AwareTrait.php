<?php

namespace Neighborhoods\Kojo\Notification\Builder\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotificationBuilderFactory = null;

    public function setRETS1NotificationBuilderFactory(\Neighborhoods\Kojo\Notification\Builder\FactoryInterface $RETS1NotificationBuilderFactory) : self
    {
        if ($this->hasRETS1NotificationBuilderFactory()) {
            throw new \LogicException('RETS1NotificationBuilderFactory is already set.');
        }
        $this->RETS1NotificationBuilderFactory = $RETS1NotificationBuilderFactory;

        return $this;
    }

    protected function getRETS1NotificationBuilderFactory() : \Neighborhoods\Kojo\Notification\Builder\FactoryInterface
    {
        if (!$this->hasRETS1NotificationBuilderFactory()) {
            throw new \LogicException('RETS1NotificationBuilderFactory is not set.');
        }

        return $this->RETS1NotificationBuilderFactory;
    }

    protected function hasRETS1NotificationBuilderFactory() : bool
    {
        return isset($this->RETS1NotificationBuilderFactory);
    }

    protected function unsetRETS1NotificationBuilderFactory() : self
    {
        if (!$this->hasRETS1NotificationBuilderFactory()) {
            throw new \LogicException('RETS1NotificationBuilderFactory is not set.');
        }
        unset($this->RETS1NotificationBuilderFactory);

        return $this;
    }


}

