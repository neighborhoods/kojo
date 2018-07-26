<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker;

use Neighborhoods\Kojo\Message\BrokerInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param BrokerInterface ...$brokers */
    public function __construct(array $brokers = array(), int $flags = 0);

    public function offsetGet($index): BrokerInterface;

    /** @param BrokerInterface $broker */
    public function offsetSet($index, $broker);

    /** @param BrokerInterface $broker */
    public function append($broker);

    public function current(): BrokerInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}
