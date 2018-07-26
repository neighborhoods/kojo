<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker\Factory;

use Neighborhoods\Kojo\Message\Broker\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoMessageBrokerFactory;

    public function setMessageBrokerFactory(FactoryInterface $messageBrokerFactory): self
    {
        if ($this->hasMessageBrokerFactory()) {
            throw new \LogicException('NeighborhoodsKojoMessageBrokerFactory is already set.');
        }
        $this->NeighborhoodsKojoMessageBrokerFactory = $messageBrokerFactory;

        return $this;
    }

    protected function getMessageBrokerFactory(): FactoryInterface
    {
        if (!$this->hasMessageBrokerFactory()) {
            throw new \LogicException('NeighborhoodsKojoMessageBrokerFactory is not set.');
        }

        return $this->NeighborhoodsKojoMessageBrokerFactory;
    }

    protected function hasMessageBrokerFactory(): bool
    {
        return isset($this->NeighborhoodsKojoMessageBrokerFactory);
    }

    protected function unsetMessageBrokerFactory(): self
    {
        if (!$this->hasMessageBrokerFactory()) {
            throw new \LogicException('NeighborhoodsKojoMessageBrokerFactory is not set.');
        }
        unset($this->NeighborhoodsKojoMessageBrokerFactory);

        return $this;
    }
}
