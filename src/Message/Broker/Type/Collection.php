<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker\Type;

use Neighborhoods\Kojo\Message\Broker\BrokerInterface;
use Neighborhoods\Kojo\Message\Broker\Type\Collection\CollectionInterface;

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