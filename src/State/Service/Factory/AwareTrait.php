<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\State\Service\Factory;

use Neighborhoods\Kojo\State\Service\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateServiceFactory;

    public function setStateServiceFactory(FactoryInterface $stateServiceFactory): self
    {
        if ($this->hasStateServiceFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateServiceFactory is already set.');
        }
        $this->NeighborhoodsKojoStateServiceFactory = $stateServiceFactory;

        return $this;
    }

    protected function getStateServiceFactory(): FactoryInterface
    {
        if (!$this->hasStateServiceFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateServiceFactory is not set.');
        }

        return $this->NeighborhoodsKojoStateServiceFactory;
    }

    protected function hasStateServiceFactory(): bool
    {
        return isset($this->NeighborhoodsKojoStateServiceFactory);
    }

    protected function unsetStateServiceFactory(): self
    {
        if (!$this->hasStateServiceFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateServiceFactory is not set.');
        }
        unset($this->NeighborhoodsKojoStateServiceFactory);

        return $this;
    }
}
