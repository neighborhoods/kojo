<?php

namespace Neighborhoods\Kojo\Notifier\Builder;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotifierBuilder = null;

    public function setRETS1NotifierBuilder(\Neighborhoods\Kojo\Notifier\BuilderInterface $RETS1NotifierBuilder) : self
    {
        if ($this->hasRETS1NotifierBuilder()) {
            throw new \LogicException('RETS1NotifierBuilder is already set.');
        }
        $this->RETS1NotifierBuilder = $RETS1NotifierBuilder;

        return $this;
    }

    protected function getRETS1NotifierBuilder() : \Neighborhoods\Kojo\Notifier\BuilderInterface
    {
        if (!$this->hasRETS1NotifierBuilder()) {
            throw new \LogicException('RETS1NotifierBuilder is not set.');
        }

        return $this->RETS1NotifierBuilder;
    }

    protected function hasRETS1NotifierBuilder() : bool
    {
        return isset($this->RETS1NotifierBuilder);
    }

    protected function unsetRETS1NotifierBuilder() : self
    {
        if (!$this->hasRETS1NotifierBuilder()) {
            throw new \LogicException('RETS1NotifierBuilder is not set.');
        }
        unset($this->RETS1NotifierBuilder);

        return $this;
    }


}

