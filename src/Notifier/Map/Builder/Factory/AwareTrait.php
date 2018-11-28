<?php

namespace Neighborhoods\Kojo\Notifier\Map\Builder\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotifierMapBuilderFactory = null;

    public function setAskNotifierMapBuilderFactory(\Neighborhoods\Kojo\Notifier\Map\Builder\FactoryInterface $AskNotifierMapBuilderFactory) : self
    {
        if ($this->hasAskNotifierMapBuilderFactory()) {
            throw new \LogicException('AskNotifierMapBuilderFactory is already set.');
        }
        $this->AskNotifierMapBuilderFactory = $AskNotifierMapBuilderFactory;

        return $this;
    }

    protected function getAskNotifierMapBuilderFactory() : \Neighborhoods\Kojo\Notifier\Map\Builder\FactoryInterface
    {
        if (!$this->hasAskNotifierMapBuilderFactory()) {
            throw new \LogicException('AskNotifierMapBuilderFactory is not set.');
        }

        return $this->AskNotifierMapBuilderFactory;
    }

    protected function hasAskNotifierMapBuilderFactory() : bool
    {
        return isset($this->AskNotifierMapBuilderFactory);
    }

    protected function unsetAskNotifierMapBuilderFactory() : self
    {
        if (!$this->hasAskNotifierMapBuilderFactory()) {
            throw new \LogicException('AskNotifierMapBuilderFactory is not set.');
        }
        unset($this->AskNotifierMapBuilderFactory);

        return $this;
    }


}

