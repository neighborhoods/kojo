<?php

namespace Neighborhoods\Kojo\Notifier\Map\Builder\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotifierMapBuilderFactory = null;

    public function setRETS1NotifierMapBuilderFactory(\Neighborhoods\Kojo\Notifier\Map\Builder\FactoryInterface $RETS1NotifierMapBuilderFactory) : self
    {
        if ($this->hasRETS1NotifierMapBuilderFactory()) {
            throw new \LogicException('RETS1NotifierMapBuilderFactory is already set.');
        }
        $this->RETS1NotifierMapBuilderFactory = $RETS1NotifierMapBuilderFactory;

        return $this;
    }

    protected function getRETS1NotifierMapBuilderFactory() : \Neighborhoods\Kojo\Notifier\Map\Builder\FactoryInterface
    {
        if (!$this->hasRETS1NotifierMapBuilderFactory()) {
            throw new \LogicException('RETS1NotifierMapBuilderFactory is not set.');
        }

        return $this->RETS1NotifierMapBuilderFactory;
    }

    protected function hasRETS1NotifierMapBuilderFactory() : bool
    {
        return isset($this->RETS1NotifierMapBuilderFactory);
    }

    protected function unsetRETS1NotifierMapBuilderFactory() : self
    {
        if (!$this->hasRETS1NotifierMapBuilderFactory()) {
            throw new \LogicException('RETS1NotifierMapBuilderFactory is not set.');
        }
        unset($this->RETS1NotifierMapBuilderFactory);

        return $this;
    }


}

