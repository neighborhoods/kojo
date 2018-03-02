<?php
declare(strict_types=1);

namespace NHDS\Jobs\Message\Broker\Type;

use NHDS\Jobs\Message\Broker\BrokerInterface;
use NHDS\Jobs\Message\Broker\Type\Collection\CollectionInterface;

class Collection implements CollectionInterface
{
    protected $_types = [];

    public function addBrokerType(string $typeCode, BrokerInterface $process)
    {
        if (isset($this->_types[$typeCode])) {
            throw new \LogicException('Broker type is already set.');
        }
        $this->_types[$typeCode] = $process;

        return $this;
    }

    public function getBrokerTypeClone(string $typeCode): BrokerInterface
    {
        if (!isset($this->_types[$typeCode])) {
            throw new \LogicException('Broker type is not set.');
        }

        return clone $this->_types[$typeCode];
    }
}