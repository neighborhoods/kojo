<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy\Factory;

use Neighborhoods\Kojo\Process\Pool\Strategy\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolStrategyFactory;

    public function setProcessPoolStrategyFactory(FactoryInterface $processPoolStrategyFactory): self
    {
        if ($this->hasProcessPoolStrategyFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategyFactory is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolStrategyFactory = $processPoolStrategyFactory;

        return $this;
    }

    protected function getProcessPoolStrategyFactory(): FactoryInterface
    {
        if (!$this->hasProcessPoolStrategyFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategyFactory is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolStrategyFactory;
    }

    protected function hasProcessPoolStrategyFactory(): bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolStrategyFactory);
    }

    protected function unsetProcessPoolStrategyFactory(): self
    {
        if (!$this->hasProcessPoolStrategyFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategyFactory is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolStrategyFactory);

        return $this;
    }
}
