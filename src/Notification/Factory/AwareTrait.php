<?php

namespace Neighborhoods\Kojo\Notification\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotificationFactory = null;

    public function setAskNotificationFactory(\Neighborhoods\Kojo\Notification\FactoryInterface $AskNotificationFactory) : self
    {
        if ($this->hasAskNotificationFactory()) {
            throw new \LogicException('AskNotificationFactory is already set.');
        }
        $this->AskNotificationFactory = $AskNotificationFactory;

        return $this;
    }

    protected function getAskNotificationFactory() : \Neighborhoods\Kojo\Notification\FactoryInterface
    {
        if (!$this->hasAskNotificationFactory()) {
            throw new \LogicException('AskNotificationFactory is not set.');
        }

        return $this->AskNotificationFactory;
    }

    protected function hasAskNotificationFactory() : bool
    {
        return isset($this->AskNotificationFactory);
    }

    protected function unsetAskNotificationFactory() : self
    {
        if (!$this->hasAskNotificationFactory()) {
            throw new \LogicException('AskNotificationFactory is not set.');
        }
        unset($this->AskNotificationFactory);

        return $this;
    }


}

