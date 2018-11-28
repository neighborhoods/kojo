<?php

namespace Neighborhoods\Kojo\Notification\Map\Builder;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotificationMapBuilder = null;

    public function setAskNotificationMapBuilder(\Neighborhoods\Kojo\Notification\Map\BuilderInterface $AskNotificationMapBuilder) : self
    {
        if ($this->hasAskNotificationMapBuilder()) {
            throw new \LogicException('AskNotificationMapBuilder is already set.');
        }
        $this->AskNotificationMapBuilder = $AskNotificationMapBuilder;

        return $this;
    }

    protected function getAskNotificationMapBuilder() : \Neighborhoods\Kojo\Notification\Map\BuilderInterface
    {
        if (!$this->hasAskNotificationMapBuilder()) {
            throw new \LogicException('AskNotificationMapBuilder is not set.');
        }

        return $this->AskNotificationMapBuilder;
    }

    protected function hasAskNotificationMapBuilder() : bool
    {
        return isset($this->AskNotificationMapBuilder);
    }

    protected function unsetAskNotificationMapBuilder() : self
    {
        if (!$this->hasAskNotificationMapBuilder()) {
            throw new \LogicException('AskNotificationMapBuilder is not set.');
        }
        unset($this->AskNotificationMapBuilder);

        return $this;
    }


}

