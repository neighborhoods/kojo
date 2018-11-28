<?php

namespace Neighborhoods\Kojo\Notifier\Map\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotifierMapFactory = null;

    public function setAskNotifierMapFactory(\Neighborhoods\Kojo\Notifier\Map\FactoryInterface $AskNotifierMapFactory) : self
    {
        if ($this->hasAskNotifierMapFactory()) {
            throw new \LogicException('AskNotifierMapFactory is already set.');
        }
        $this->AskNotifierMapFactory = $AskNotifierMapFactory;

        return $this;
    }

    protected function getAskNotifierMapFactory() : \Neighborhoods\Kojo\Notifier\Map\FactoryInterface
    {
        if (!$this->hasAskNotifierMapFactory()) {
            throw new \LogicException('AskNotifierMapFactory is not set.');
        }

        return $this->AskNotifierMapFactory;
    }

    protected function hasAskNotifierMapFactory() : bool
    {
        return isset($this->AskNotifierMapFactory);
    }

    protected function unsetAskNotifierMapFactory() : self
    {
        if (!$this->hasAskNotifierMapFactory()) {
            throw new \LogicException('AskNotifierMapFactory is not set.');
        }
        unset($this->AskNotifierMapFactory);

        return $this;
    }


}

