<?php

namespace Neighborhoods\Kojo\Notifier\Map\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotifierMapFactory = null;

    public function setRETS1NotifierMapFactory(\Neighborhoods\Kojo\Notifier\Map\FactoryInterface $RETS1NotifierMapFactory) : self
    {
        if ($this->hasRETS1NotifierMapFactory()) {
            throw new \LogicException('RETS1NotifierMapFactory is already set.');
        }
        $this->RETS1NotifierMapFactory = $RETS1NotifierMapFactory;

        return $this;
    }

    protected function getRETS1NotifierMapFactory() : \Neighborhoods\Kojo\Notifier\Map\FactoryInterface
    {
        if (!$this->hasRETS1NotifierMapFactory()) {
            throw new \LogicException('RETS1NotifierMapFactory is not set.');
        }

        return $this->RETS1NotifierMapFactory;
    }

    protected function hasRETS1NotifierMapFactory() : bool
    {
        return isset($this->RETS1NotifierMapFactory);
    }

    protected function unsetRETS1NotifierMapFactory() : self
    {
        if (!$this->hasRETS1NotifierMapFactory()) {
            throw new \LogicException('RETS1NotifierMapFactory is not set.');
        }
        unset($this->RETS1NotifierMapFactory);

        return $this;
    }


}

