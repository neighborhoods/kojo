<?php

namespace Neighborhoods\Kojo\Notifier\Builder\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotifierBuilderFactory = null;

    public function setAskNotifierBuilderFactory(\Neighborhoods\Kojo\Notifier\Builder\FactoryInterface $AskNotifierBuilderFactory) : self
    {
        if ($this->hasAskNotifierBuilderFactory()) {
            throw new \LogicException('AskNotifierBuilderFactory is already set.');
        }
        $this->AskNotifierBuilderFactory = $AskNotifierBuilderFactory;

        return $this;
    }

    protected function getAskNotifierBuilderFactory() : \Neighborhoods\Kojo\Notifier\Builder\FactoryInterface
    {
        if (!$this->hasAskNotifierBuilderFactory()) {
            throw new \LogicException('AskNotifierBuilderFactory is not set.');
        }

        return $this->AskNotifierBuilderFactory;
    }

    protected function hasAskNotifierBuilderFactory() : bool
    {
        return isset($this->AskNotifierBuilderFactory);
    }

    protected function unsetAskNotifierBuilderFactory() : self
    {
        if (!$this->hasAskNotifierBuilderFactory()) {
            throw new \LogicException('AskNotifierBuilderFactory is not set.');
        }
        unset($this->AskNotifierBuilderFactory);

        return $this;
    }


}

