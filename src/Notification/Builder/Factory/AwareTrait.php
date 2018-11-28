<?php

namespace Neighborhoods\Kojo\Notification\Builder\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotificationBuilderFactory = null;

    public function setAskNotificationBuilderFactory(\Neighborhoods\Kojo\Notification\Builder\FactoryInterface $AskNotificationBuilderFactory) : self
    {
        if ($this->hasAskNotificationBuilderFactory()) {
            throw new \LogicException('AskNotificationBuilderFactory is already set.');
        }
        $this->AskNotificationBuilderFactory = $AskNotificationBuilderFactory;

        return $this;
    }

    protected function getAskNotificationBuilderFactory() : \Neighborhoods\Kojo\Notification\Builder\FactoryInterface
    {
        if (!$this->hasAskNotificationBuilderFactory()) {
            throw new \LogicException('AskNotificationBuilderFactory is not set.');
        }

        return $this->AskNotificationBuilderFactory;
    }

    protected function hasAskNotificationBuilderFactory() : bool
    {
        return isset($this->AskNotificationBuilderFactory);
    }

    protected function unsetAskNotificationBuilderFactory() : self
    {
        if (!$this->hasAskNotificationBuilderFactory()) {
            throw new \LogicException('AskNotificationBuilderFactory is not set.');
        }
        unset($this->AskNotificationBuilderFactory);

        return $this;
    }


}

