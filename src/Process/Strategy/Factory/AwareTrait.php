<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Strategy\Factory;

use Neighborhoods\Kojo\Process\Strategy\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessStrategyFactory;

    public function setProcessStrategyFactory(FactoryInterface $processStrategyFactory): self
    {
        if ($this->hasProcessStrategyFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessStrategyFactory is already set.');
        }
        $this->NeighborhoodsKojoProcessStrategyFactory = $processStrategyFactory;

        return $this;
    }

    protected function getProcessStrategyFactory(): FactoryInterface
    {
        if (!$this->hasProcessStrategyFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessStrategyFactory is not set.');
        }

        return $this->NeighborhoodsKojoProcessStrategyFactory;
    }

    protected function hasProcessStrategyFactory(): bool
    {
        return isset($this->NeighborhoodsKojoProcessStrategyFactory);
    }

    protected function unsetProcessStrategyFactory(): self
    {
        if (!$this->hasProcessStrategyFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessStrategyFactory is not set.');
        }
        unset($this->NeighborhoodsKojoProcessStrategyFactory);

        return $this;
    }
}
