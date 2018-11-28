<?php

namespace Neighborhoods\Kojo\Notifier\Map\Repository\Handler;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotifierMapRepositoryHandler = null;

    public function setAskNotifierMapRepositoryHandler(\Neighborhoods\Kojo\Notifier\Map\Repository\HandlerInterface $AskNotifierMapRepositoryHandler) : self
    {
        if ($this->hasAskNotifierMapRepositoryHandler()) {
            throw new \LogicException('AskNotifierMapRepositoryHandler is already set.');
        }
        $this->AskNotifierMapRepositoryHandler = $AskNotifierMapRepositoryHandler;

        return $this;
    }

    protected function getAskNotifierMapRepositoryHandler() : \Neighborhoods\Kojo\Notifier\Map\Repository\HandlerInterface
    {
        if (!$this->hasAskNotifierMapRepositoryHandler()) {
            throw new \LogicException('AskNotifierMapRepositoryHandler is not set.');
        }

        return $this->AskNotifierMapRepositoryHandler;
    }

    protected function hasAskNotifierMapRepositoryHandler() : bool
    {
        return isset($this->AskNotifierMapRepositoryHandler);
    }

    protected function unsetAskNotifierMapRepositoryHandler() : self
    {
        if (!$this->hasAskNotifierMapRepositoryHandler()) {
            throw new \LogicException('AskNotifierMapRepositoryHandler is not set.');
        }
        unset($this->AskNotifierMapRepositoryHandler);

        return $this;
    }


}

