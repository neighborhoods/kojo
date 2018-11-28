<?php

namespace Neighborhoods\Kojo\Notifier\Repository\Handler;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotifierRepositoryHandler = null;

    public function setAskNotifierRepositoryHandler(\Neighborhoods\Kojo\Notifier\Repository\HandlerInterface $AskNotifierRepositoryHandler) : self
    {
        if ($this->hasAskNotifierRepositoryHandler()) {
            throw new \LogicException('AskNotifierRepositoryHandler is already set.');
        }
        $this->AskNotifierRepositoryHandler = $AskNotifierRepositoryHandler;

        return $this;
    }

    protected function getAskNotifierRepositoryHandler() : \Neighborhoods\Kojo\Notifier\Repository\HandlerInterface
    {
        if (!$this->hasAskNotifierRepositoryHandler()) {
            throw new \LogicException('AskNotifierRepositoryHandler is not set.');
        }

        return $this->AskNotifierRepositoryHandler;
    }

    protected function hasAskNotifierRepositoryHandler() : bool
    {
        return isset($this->AskNotifierRepositoryHandler);
    }

    protected function unsetAskNotifierRepositoryHandler() : self
    {
        if (!$this->hasAskNotifierRepositoryHandler()) {
            throw new \LogicException('AskNotifierRepositoryHandler is not set.');
        }
        unset($this->AskNotifierRepositoryHandler);

        return $this;
    }


}

