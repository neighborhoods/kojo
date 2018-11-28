<?php

namespace Neighborhoods\Kojo\Notifier\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotifierFactory = null;

    public function setAskNotifierFactory(\Neighborhoods\Kojo\Notifier\FactoryInterface $AskNotifierFactory) : self
    {
        if ($this->hasAskNotifierFactory()) {
            throw new \LogicException('AskNotifierFactory is already set.');
        }
        $this->AskNotifierFactory = $AskNotifierFactory;

        return $this;
    }

    protected function getAskNotifierFactory() : \Neighborhoods\Kojo\Notifier\FactoryInterface
    {
        if (!$this->hasAskNotifierFactory()) {
            throw new \LogicException('AskNotifierFactory is not set.');
        }

        return $this->AskNotifierFactory;
    }

    protected function hasAskNotifierFactory() : bool
    {
        return isset($this->AskNotifierFactory);
    }

    protected function unsetAskNotifierFactory() : self
    {
        if (!$this->hasAskNotifierFactory()) {
            throw new \LogicException('AskNotifierFactory is not set.');
        }
        unset($this->AskNotifierFactory);

        return $this;
    }


}

