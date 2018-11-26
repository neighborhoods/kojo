<?php

namespace Neighborhoods\Kojo\Notifier\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotifierFactory = null;

    public function setRETS1NotifierFactory(\Neighborhoods\Kojo\Notifier\FactoryInterface $RETS1NotifierFactory) : self
    {
        if ($this->hasRETS1NotifierFactory()) {
            throw new \LogicException('RETS1NotifierFactory is already set.');
        }
        $this->RETS1NotifierFactory = $RETS1NotifierFactory;

        return $this;
    }

    protected function getRETS1NotifierFactory() : \Neighborhoods\Kojo\Notifier\FactoryInterface
    {
        if (!$this->hasRETS1NotifierFactory()) {
            throw new \LogicException('RETS1NotifierFactory is not set.');
        }

        return $this->RETS1NotifierFactory;
    }

    protected function hasRETS1NotifierFactory() : bool
    {
        return isset($this->RETS1NotifierFactory);
    }

    protected function unsetRETS1NotifierFactory() : self
    {
        if (!$this->hasRETS1NotifierFactory()) {
            throw new \LogicException('RETS1NotifierFactory is not set.');
        }
        unset($this->RETS1NotifierFactory);

        return $this;
    }


}

