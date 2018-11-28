<?php

namespace Neighborhoods\Kojo\Notifier\Builder;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotifierBuilder = null;

    public function setAskNotifierBuilder(\Neighborhoods\Kojo\Notifier\BuilderInterface $AskNotifierBuilder) : self
    {
        if ($this->hasAskNotifierBuilder()) {
            throw new \LogicException('AskNotifierBuilder is already set.');
        }
        $this->AskNotifierBuilder = $AskNotifierBuilder;

        return $this;
    }

    protected function getAskNotifierBuilder() : \Neighborhoods\Kojo\Notifier\BuilderInterface
    {
        if (!$this->hasAskNotifierBuilder()) {
            throw new \LogicException('AskNotifierBuilder is not set.');
        }

        return $this->AskNotifierBuilder;
    }

    protected function hasAskNotifierBuilder() : bool
    {
        return isset($this->AskNotifierBuilder);
    }

    protected function unsetAskNotifierBuilder() : self
    {
        if (!$this->hasAskNotifierBuilder()) {
            throw new \LogicException('AskNotifierBuilder is not set.');
        }
        unset($this->AskNotifierBuilder);

        return $this;
    }


}

