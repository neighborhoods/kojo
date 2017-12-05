<?php

namespace NHDS\Jobs\Message\Broker;

trait AwareTrait
{
    public function setBroker(BrokerInterface $broker)
    {
        $this->_create(BrokerInterface::class, $broker);

        return $this;
    }

    protected function _getBroker(): BrokerInterface
    {
        return $this->_read(BrokerInterface::class);
    }

    protected function _getBrokerClone(): BrokerInterface
    {
        return clone $this->_getBroker();
    }
}