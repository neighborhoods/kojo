<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker\Map;

use Neighborhoods\Kojo\Message\Broker\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoMessageBrokerMap;

    public function setMessageBrokerMap(MapInterface $messageBrokerMap): self
    {
        if ($this->hasMessageBrokerMap()) {
            throw new \LogicException('NeighborhoodsKojoMessageBrokerMap is already set.');
        }
        $this->NeighborhoodsKojoMessageBrokerMap = $messageBrokerMap;

        return $this;
    }

    protected function getMessageBrokerMap(): MapInterface
    {
        if (!$this->hasMessageBrokerMap()) {
            throw new \LogicException('NeighborhoodsKojoMessageBrokerMap is not set.');
        }

        return $this->NeighborhoodsKojoMessageBrokerMap;
    }

    protected function hasMessageBrokerMap(): bool
    {
        return isset($this->NeighborhoodsKojoMessageBrokerMap);
    }

    protected function unsetMessageBrokerMap(): self
    {
        if (!$this->hasMessageBrokerMap()) {
            throw new \LogicException('NeighborhoodsKojoMessageBrokerMap is not set.');
        }
        unset($this->NeighborhoodsKojoMessageBrokerMap);

        return $this;
    }
}
