<?php

namespace Neighborhoods\Kojo\Notification\Map\Builder\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotificationMapBuilderFactory = null;

    public function setAskNotificationMapBuilderFactory(\Neighborhoods\Kojo\Notification\Map\Builder\FactoryInterface $AskNotificationMapBuilderFactory) : self
    {
        if ($this->hasAskNotificationMapBuilderFactory()) {
            throw new \LogicException('AskNotificationMapBuilderFactory is already set.');
        }
        $this->AskNotificationMapBuilderFactory = $AskNotificationMapBuilderFactory;

        return $this;
    }

    protected function getAskNotificationMapBuilderFactory() : \Neighborhoods\Kojo\Notification\Map\Builder\FactoryInterface
    {
        if (!$this->hasAskNotificationMapBuilderFactory()) {
            throw new \LogicException('AskNotificationMapBuilderFactory is not set.');
        }

        return $this->AskNotificationMapBuilderFactory;
    }

    protected function hasAskNotificationMapBuilderFactory() : bool
    {
        return isset($this->AskNotificationMapBuilderFactory);
    }

    protected function unsetAskNotificationMapBuilderFactory() : self
    {
        if (!$this->hasAskNotificationMapBuilderFactory()) {
            throw new \LogicException('AskNotificationMapBuilderFactory is not set.');
        }
        unset($this->AskNotificationMapBuilderFactory);

        return $this;
    }


}

