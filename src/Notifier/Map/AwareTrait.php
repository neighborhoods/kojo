<?php

namespace Neighborhoods\Kojo\Notifier\Map;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotifierMap = null;

    public function setAskNotifierMap(\Neighborhoods\Kojo\Notifier\MapInterface $AskNotifierMap) : self
    {
        if ($this->hasAskNotifierMap()) {
            throw new \LogicException('AskNotifierMap is already set.');
        }
        $this->AskNotifierMap = $AskNotifierMap;

        return $this;
    }

    protected function getAskNotifierMap() : \Neighborhoods\Kojo\Notifier\MapInterface
    {
        if (!$this->hasAskNotifierMap()) {
            throw new \LogicException('AskNotifierMap is not set.');
        }

        return $this->AskNotifierMap;
    }

    protected function hasAskNotifierMap() : bool
    {
        return isset($this->AskNotifierMap);
    }

    protected function unsetAskNotifierMap() : self
    {
        if (!$this->hasAskNotifierMap()) {
            throw new \LogicException('AskNotifierMap is not set.');
        }
        unset($this->AskNotifierMap);

        return $this;
    }


}

