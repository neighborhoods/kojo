<?php
declare(strict_types=1);

namespace NHDS\Jobs\Message\Broker\Type\Collection;

use NHDS\Jobs\Message\Broker\BrokerInterface;
use NHDS\Jobs\Message\Broker\Type\Collection;

trait AwareTrait
{
    protected $_brokerTypeCollection;
    protected $_brokerTypeCode;

    public function setBrokerTypeCollection(Collection $brokerTypeCollection)
    {
        if ($this->_brokerTypeCollection === null) {
            $this->_brokerTypeCollection = $brokerTypeCollection;
        }else {
            throw new \Exception('Broker type collection is already set.');
        }

        return $this;
    }

    protected function _getBrokerTypeCollection(): Collection
    {
        if ($this->_brokerTypeCollection === null) {
            throw new \LogicException('Broker type collection is not set.');
        }

        return $this->_brokerTypeCollection;
    }

    public function setBrokerTypeCode(string $brokerTypeCode)
    {
        if ($this->_brokerTypeCode === null) {
            $this->_brokerTypeCode = $brokerTypeCode;
        }else {
            throw new \LogicException('Broker type code is already set.');
        }

        return $this;
    }

    protected function _getBrokerTypeCode(): string
    {
        if ($this->_brokerTypeCode === null) {
            throw new \LogicException('Broker type code is not set.');
        }

        return $this->_brokerTypeCode;
    }

    protected function _getMessageBroker(): BrokerInterface
    {
        if ($this->_messageBroker === null) {
            $this->_messageBroker = $this->_getBrokerTypeCollection()->getBrokerTypeClone($this->_getBrokerTypeCode());
        }

        return $this->_messageBroker;
    }
}