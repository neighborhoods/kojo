<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker\Repository;

use Neighborhoods\Kojo\Message\Broker\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoMessageBrokerRepository;

    public function setMessageBrokerRepository(RepositoryInterface $messageBrokerRepository): self
    {
        if ($this->hasMessageBrokerRepository()) {
            throw new \LogicException('NeighborhoodsKojoMessageBrokerRepository is already set.');
        }
        $this->NeighborhoodsKojoMessageBrokerRepository = $messageBrokerRepository;

        return $this;
    }

    protected function getMessageBrokerRepository(): RepositoryInterface
    {
        if (!$this->hasMessageBrokerRepository()) {
            throw new \LogicException('NeighborhoodsKojoMessageBrokerRepository is not set.');
        }

        return $this->NeighborhoodsKojoMessageBrokerRepository;
    }

    protected function hasMessageBrokerRepository(): bool
    {
        return isset($this->NeighborhoodsKojoMessageBrokerRepository);
    }

    protected function unsetMessageBrokerRepository(): self
    {
        if (!$this->hasMessageBrokerRepository()) {
            throw new \LogicException('NeighborhoodsKojoMessageBrokerRepository is not set.');
        }
        unset($this->NeighborhoodsKojoMessageBrokerRepository);

        return $this;
    }
}
