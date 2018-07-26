<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy;

use Neighborhoods\Kojo\Process\Pool\StrategyInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolStrategy;

    public function setProcessPoolStrategy(StrategyInterface $processPoolStrategy): self
    {
        if ($this->hasProcessPoolStrategy()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategy is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolStrategy = $processPoolStrategy;

        return $this;
    }

    protected function getProcessPoolStrategy(): StrategyInterface
    {
        if (!$this->hasProcessPoolStrategy()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategy is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolStrategy;
    }

    protected function hasProcessPoolStrategy(): bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolStrategy);
    }

    protected function unsetProcessPoolStrategy(): self
    {
        if (!$this->hasProcessPoolStrategy()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategy is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolStrategy);

        return $this;
    }
}
