<?php

namespace Neighborhoods\Kojo\Notifier\Map\Builder;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotifierMapBuilder = null;

    public function setAskNotifierMapBuilder(\Neighborhoods\Kojo\Notifier\Map\BuilderInterface $AskNotifierMapBuilder) : self
    {
        if ($this->hasAskNotifierMapBuilder()) {
            throw new \LogicException('AskNotifierMapBuilder is already set.');
        }
        $this->AskNotifierMapBuilder = $AskNotifierMapBuilder;

        return $this;
    }

    protected function getAskNotifierMapBuilder() : \Neighborhoods\Kojo\Notifier\Map\BuilderInterface
    {
        if (!$this->hasAskNotifierMapBuilder()) {
            throw new \LogicException('AskNotifierMapBuilder is not set.');
        }

        return $this->AskNotifierMapBuilder;
    }

    protected function hasAskNotifierMapBuilder() : bool
    {
        return isset($this->AskNotifierMapBuilder);
    }

    protected function unsetAskNotifierMapBuilder() : self
    {
        if (!$this->hasAskNotifierMapBuilder()) {
            throw new \LogicException('AskNotifierMapBuilder is not set.');
        }
        unset($this->AskNotifierMapBuilder);

        return $this;
    }


}

