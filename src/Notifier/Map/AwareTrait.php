<?php

namespace Neighborhoods\Kojo\Notifier\Map;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotifierMap = null;

    public function setRETS1NotifierMap(\Neighborhoods\Kojo\Notifier\MapInterface $RETS1NotifierMap) : self
    {
        if ($this->hasRETS1NotifierMap()) {
            throw new \LogicException('RETS1NotifierMap is already set.');
        }
        $this->RETS1NotifierMap = $RETS1NotifierMap;

        return $this;
    }

    protected function getRETS1NotifierMap() : \Neighborhoods\Kojo\Notifier\MapInterface
    {
        if (!$this->hasRETS1NotifierMap()) {
            throw new \LogicException('RETS1NotifierMap is not set.');
        }

        return $this->RETS1NotifierMap;
    }

    protected function hasRETS1NotifierMap() : bool
    {
        return isset($this->RETS1NotifierMap);
    }

    protected function unsetRETS1NotifierMap() : self
    {
        if (!$this->hasRETS1NotifierMap()) {
            throw new \LogicException('RETS1NotifierMap is not set.');
        }
        unset($this->RETS1NotifierMap);

        return $this;
    }


}

