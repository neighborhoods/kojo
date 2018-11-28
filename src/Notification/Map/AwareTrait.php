<?php

namespace Neighborhoods\Kojo\Notification\Map;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotificationMap = null;

    public function setAskNotificationMap(\Neighborhoods\Kojo\Notification\MapInterface $AskNotificationMap) : self
    {
        if ($this->hasAskNotificationMap()) {
            throw new \LogicException('AskNotificationMap is already set.');
        }
        $this->AskNotificationMap = $AskNotificationMap;

        return $this;
    }

    protected function getAskNotificationMap() : \Neighborhoods\Kojo\Notification\MapInterface
    {
        if (!$this->hasAskNotificationMap()) {
            throw new \LogicException('AskNotificationMap is not set.');
        }

        return $this->AskNotificationMap;
    }

    protected function hasAskNotificationMap() : bool
    {
        return isset($this->AskNotificationMap);
    }

    protected function unsetAskNotificationMap() : self
    {
        if (!$this->hasAskNotificationMap()) {
            throw new \LogicException('AskNotificationMap is not set.');
        }
        unset($this->AskNotificationMap);

        return $this;
    }


}

