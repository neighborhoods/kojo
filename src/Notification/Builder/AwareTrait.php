<?php

namespace Neighborhoods\Kojo\Notification\Builder;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotificationBuilder = null;

    public function setAskNotificationBuilder(\Neighborhoods\Kojo\Notification\BuilderInterface $AskNotificationBuilder) : self
    {
        if ($this->hasAskNotificationBuilder()) {
            throw new \LogicException('AskNotificationBuilder is already set.');
        }
        $this->AskNotificationBuilder = $AskNotificationBuilder;

        return $this;
    }

    protected function getAskNotificationBuilder() : \Neighborhoods\Kojo\Notification\BuilderInterface
    {
        if (!$this->hasAskNotificationBuilder()) {
            throw new \LogicException('AskNotificationBuilder is not set.');
        }

        return $this->AskNotificationBuilder;
    }

    protected function hasAskNotificationBuilder() : bool
    {
        return isset($this->AskNotificationBuilder);
    }

    protected function unsetAskNotificationBuilder() : self
    {
        if (!$this->hasAskNotificationBuilder()) {
            throw new \LogicException('AskNotificationBuilder is not set.');
        }
        unset($this->AskNotificationBuilder);

        return $this;
    }


}

