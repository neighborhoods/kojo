<?php

namespace Neighborhoods\Kojo\Notifier;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1Notifier = null;

    public function setRETS1Notifier(\Neighborhoods\Kojo\NotifierInterface $RETS1Notifier) : self
    {
        if ($this->hasRETS1Notifier()) {
            throw new \LogicException('RETS1Notifier is already set.');
        }
        $this->RETS1Notifier = $RETS1Notifier;

        return $this;
    }

    protected function getRETS1Notifier() : \Neighborhoods\Kojo\NotifierInterface
    {
        if (!$this->hasRETS1Notifier()) {
            throw new \LogicException('RETS1Notifier is not set.');
        }

        return $this->RETS1Notifier;
    }

    protected function hasRETS1Notifier() : bool
    {
        return isset($this->RETS1Notifier);
    }

    protected function unsetRETS1Notifier() : self
    {
        if (!$this->hasRETS1Notifier()) {
            throw new \LogicException('RETS1Notifier is not set.');
        }
        unset($this->RETS1Notifier);

        return $this;
    }


}

