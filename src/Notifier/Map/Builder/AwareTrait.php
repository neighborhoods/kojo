<?php

namespace Neighborhoods\Kojo\Notifier\Map\Builder;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotifierMapBuilder = null;

    public function setRETS1NotifierMapBuilder(\Neighborhoods\Kojo\Notifier\Map\BuilderInterface $RETS1NotifierMapBuilder) : self
    {
        if ($this->hasRETS1NotifierMapBuilder()) {
            throw new \LogicException('RETS1NotifierMapBuilder is already set.');
        }
        $this->RETS1NotifierMapBuilder = $RETS1NotifierMapBuilder;

        return $this;
    }

    protected function getRETS1NotifierMapBuilder() : \Neighborhoods\Kojo\Notifier\Map\BuilderInterface
    {
        if (!$this->hasRETS1NotifierMapBuilder()) {
            throw new \LogicException('RETS1NotifierMapBuilder is not set.');
        }

        return $this->RETS1NotifierMapBuilder;
    }

    protected function hasRETS1NotifierMapBuilder() : bool
    {
        return isset($this->RETS1NotifierMapBuilder);
    }

    protected function unsetRETS1NotifierMapBuilder() : self
    {
        if (!$this->hasRETS1NotifierMapBuilder()) {
            throw new \LogicException('RETS1NotifierMapBuilder is not set.');
        }
        unset($this->RETS1NotifierMapBuilder);

        return $this;
    }


}

