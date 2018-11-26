<?php

namespace Neighborhoods\Kojo\Notifier\Builder\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotifierBuilderFactory = null;

    public function setRETS1NotifierBuilderFactory(\Neighborhoods\Kojo\Notifier\Builder\FactoryInterface $RETS1NotifierBuilderFactory) : self
    {
        if ($this->hasRETS1NotifierBuilderFactory()) {
            throw new \LogicException('RETS1NotifierBuilderFactory is already set.');
        }
        $this->RETS1NotifierBuilderFactory = $RETS1NotifierBuilderFactory;

        return $this;
    }

    protected function getRETS1NotifierBuilderFactory() : \Neighborhoods\Kojo\Notifier\Builder\FactoryInterface
    {
        if (!$this->hasRETS1NotifierBuilderFactory()) {
            throw new \LogicException('RETS1NotifierBuilderFactory is not set.');
        }

        return $this->RETS1NotifierBuilderFactory;
    }

    protected function hasRETS1NotifierBuilderFactory() : bool
    {
        return isset($this->RETS1NotifierBuilderFactory);
    }

    protected function unsetRETS1NotifierBuilderFactory() : self
    {
        if (!$this->hasRETS1NotifierBuilderFactory()) {
            throw new \LogicException('RETS1NotifierBuilderFactory is not set.');
        }
        unset($this->RETS1NotifierBuilderFactory);

        return $this;
    }


}

