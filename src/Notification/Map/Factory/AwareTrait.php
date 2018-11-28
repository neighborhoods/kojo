<?php

namespace Neighborhoods\Kojo\Notification\Map\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotificationMapFactory = null;

    public function setAskNotificationMapFactory(\Neighborhoods\Kojo\Notification\Map\FactoryInterface $AskNotificationMapFactory) : self
    {
        if ($this->hasAskNotificationMapFactory()) {
            throw new \LogicException('AskNotificationMapFactory is already set.');
        }
        $this->AskNotificationMapFactory = $AskNotificationMapFactory;

        return $this;
    }

    protected function getAskNotificationMapFactory() : \Neighborhoods\Kojo\Notification\Map\FactoryInterface
    {
        if (!$this->hasAskNotificationMapFactory()) {
            throw new \LogicException('AskNotificationMapFactory is not set.');
        }

        return $this->AskNotificationMapFactory;
    }

    protected function hasAskNotificationMapFactory() : bool
    {
        return isset($this->AskNotificationMapFactory);
    }

    protected function unsetAskNotificationMapFactory() : self
    {
        if (!$this->hasAskNotificationMapFactory()) {
            throw new \LogicException('AskNotificationMapFactory is not set.');
        }
        unset($this->AskNotificationMapFactory);

        return $this;
    }


}

