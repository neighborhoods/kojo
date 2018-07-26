<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Strategy;

use Neighborhoods\Kojo\Process\StrategyInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessStrategy;

    public function setProcessStrategy(StrategyInterface $processStrategy): self
    {
        if ($this->hasProcessStrategy()) {
            throw new \LogicException('NeighborhoodsKojoProcessStrategy is already set.');
        }
        $this->NeighborhoodsKojoProcessStrategy = $processStrategy;

        return $this;
    }

    protected function getProcessStrategy(): StrategyInterface
    {
        if (!$this->hasProcessStrategy()) {
            throw new \LogicException('NeighborhoodsKojoProcessStrategy is not set.');
        }

        return $this->NeighborhoodsKojoProcessStrategy;
    }

    protected function hasProcessStrategy(): bool
    {
        return isset($this->NeighborhoodsKojoProcessStrategy);
    }

    protected function unsetProcessStrategy(): self
    {
        if (!$this->hasProcessStrategy()) {
            throw new \LogicException('NeighborhoodsKojoProcessStrategy is not set.');
        }
        unset($this->NeighborhoodsKojoProcessStrategy);

        return $this;
    }
}
