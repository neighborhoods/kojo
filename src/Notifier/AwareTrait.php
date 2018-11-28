<?php

namespace Neighborhoods\Kojo\Notifier;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotifier = null;

    public function setAskNotifier(\Neighborhoods\Kojo\NotifierInterface $AskNotifier) : self
    {
        if ($this->hasAskNotifier()) {
            throw new \LogicException('AskNotifier is already set.');
        }
        $this->AskNotifier = $AskNotifier;

        return $this;
    }

    protected function getAskNotifier() : \Neighborhoods\Kojo\NotifierInterface
    {
        if (!$this->hasAskNotifier()) {
            throw new \LogicException('AskNotifier is not set.');
        }

        return $this->AskNotifier;
    }

    protected function hasAskNotifier() : bool
    {
        return isset($this->AskNotifier);
    }

    protected function unsetAskNotifier() : self
    {
        if (!$this->hasAskNotifier()) {
            throw new \LogicException('AskNotifier is not set.');
        }
        unset($this->AskNotifier);

        return $this;
    }


}

