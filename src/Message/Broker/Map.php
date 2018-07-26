<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker;

use Neighborhoods\Kojo\Message\BrokerInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param BrokerInterface ...$brokers */
    public function __construct(array $brokers = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($brokers)) {
            $this->assertValidArrayType(...array_values($brokers));
        }

        parent::__construct($brokers, $flags);
    }

    public function offsetGet($index): BrokerInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param BrokerInterface $broker */
    public function offsetSet($index, $broker)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($broker));
    }

    /** @param BrokerInterface $broker */
    public function append($broker)
    {
        $this->assertValidArrayItemType($broker);
        parent::append($broker);
    }

    public function current(): BrokerInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(BrokerInterface $broker)
    {
        return $broker;
    }

    protected function assertValidArrayType(BrokerInterface ...$brokers): MapInterface
    {
        return $this;
    }

    public function getArrayCopy(): MapInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray(): array
    {
        return (array)$this;
    }

    public function hydrate(array $array): MapInterface
    {
        $this->__construct($array);

        return $this;
    }
}
