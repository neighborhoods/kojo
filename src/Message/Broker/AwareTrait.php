<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker;

trait AwareTrait
{
    public function setMessageBroker(BrokerInterface $broker)
    {
        $this->_create(BrokerInterface::class, $broker);

        return $this;
    }

    protected function _getMessageBroker(): BrokerInterface
    {
        return $this->_read(BrokerInterface::class);
    }

    protected function _getMessageBrokerClone(): BrokerInterface
    {
        return clone $this->_getMessageBroker();
    }
}