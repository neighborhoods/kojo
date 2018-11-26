<?php

namespace Neighborhoods\Kojo\Notification\Map\Builder\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotificationMapBuilderFactory = null;

    public function setRETS1NotificationMapBuilderFactory(\Neighborhoods\Kojo\Notification\Map\Builder\FactoryInterface $RETS1NotificationMapBuilderFactory) : self
    {
        if ($this->hasRETS1NotificationMapBuilderFactory()) {
            throw new \LogicException('RETS1NotificationMapBuilderFactory is already set.');
        }
        $this->RETS1NotificationMapBuilderFactory = $RETS1NotificationMapBuilderFactory;

        return $this;
    }

    protected function getRETS1NotificationMapBuilderFactory() : \Neighborhoods\Kojo\Notification\Map\Builder\FactoryInterface
    {
        if (!$this->hasRETS1NotificationMapBuilderFactory()) {
            throw new \LogicException('RETS1NotificationMapBuilderFactory is not set.');
        }

        return $this->RETS1NotificationMapBuilderFactory;
    }

    protected function hasRETS1NotificationMapBuilderFactory() : bool
    {
        return isset($this->RETS1NotificationMapBuilderFactory);
    }

    protected function unsetRETS1NotificationMapBuilderFactory() : self
    {
        if (!$this->hasRETS1NotificationMapBuilderFactory()) {
            throw new \LogicException('RETS1NotificationMapBuilderFactory is not set.');
        }
        unset($this->RETS1NotificationMapBuilderFactory);

        return $this;
    }


}

