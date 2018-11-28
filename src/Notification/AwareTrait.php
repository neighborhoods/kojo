<?php

namespace Neighborhoods\Kojo\Notification;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotification = null;

    public function setAskNotification(\Neighborhoods\Kojo\NotificationInterface $AskNotification) : self
    {
        if ($this->hasAskNotification()) {
            throw new \LogicException('AskNotification is already set.');
        }
        $this->AskNotification = $AskNotification;

        return $this;
    }

    protected function getAskNotification() : \Neighborhoods\Kojo\NotificationInterface
    {
        if (!$this->hasAskNotification()) {
            throw new \LogicException('AskNotification is not set.');
        }

        return $this->AskNotification;
    }

    protected function hasAskNotification() : bool
    {
        return isset($this->AskNotification);
    }

    protected function unsetAskNotification() : self
    {
        if (!$this->hasAskNotification()) {
            throw new \LogicException('AskNotification is not set.');
        }
        unset($this->AskNotification);

        return $this;
    }


}

