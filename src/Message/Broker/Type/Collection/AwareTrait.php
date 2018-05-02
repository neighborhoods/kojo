<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker\Type\Collection;

use Neighborhoods\Kojo\Message\Broker\BrokerInterface;
use Neighborhoods\Kojo\Message\Broker\Type\Collection;

trait AwareTrait
{
    protected $_brokerTypeCode;
    protected $_messageBroker;

    public function setBrokerTypeCollection(Collection $brokerTypeCollection)
    {
        $this->_create(CollectionInterface::class, $brokerTypeCollection);

        return $this;
    }

    protected function _getBrokerTypeCollection(): Collection
    {
        return $this->_read(CollectionInterface::class);
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