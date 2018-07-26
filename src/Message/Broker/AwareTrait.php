<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker;

use Neighborhoods\Kojo\Message\BrokerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoMessageBroker;

    public function setMessageBroker(BrokerInterface $messageBroker): self
    {
        if ($this->hasMessageBroker()) {
            throw new \LogicException('NeighborhoodsKojoMessageBroker is already set.');
        }
        $this->NeighborhoodsKojoMessageBroker = $messageBroker;

        return $this;
    }

    protected function getMessageBroker(): BrokerInterface
    {
        if (!$this->hasMessageBroker()) {
            throw new \LogicException('NeighborhoodsKojoMessageBroker is not set.');
        }

        return $this->NeighborhoodsKojoMessageBroker;
    }

    protected function hasMessageBroker(): bool
    {
        return isset($this->NeighborhoodsKojoMessageBroker);
    }

    protected function unsetMessageBroker(): self
    {
        if (!$this->hasMessageBroker()) {
            throw new \LogicException('NeighborhoodsKojoMessageBroker is not set.');
        }
        unset($this->NeighborhoodsKojoMessageBroker);

        return $this;
    }
}
