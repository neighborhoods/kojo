<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy\Builder;

use Neighborhoods\Kojo\Process\Pool\Strategy\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolStrategyBuilder;

    public function setProcessPoolStrategyBuilder(BuilderInterface $processPoolStrategyBuilder): self
    {
        if ($this->hasProcessPoolStrategyBuilder()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategyBuilder is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolStrategyBuilder = $processPoolStrategyBuilder;

        return $this;
    }

    protected function getProcessPoolStrategyBuilder(): BuilderInterface
    {
        if (!$this->hasProcessPoolStrategyBuilder()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategyBuilder is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolStrategyBuilder;
    }

    protected function hasProcessPoolStrategyBuilder(): bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolStrategyBuilder);
    }

    protected function unsetProcessPoolStrategyBuilder(): self
    {
        if (!$this->hasProcessPoolStrategyBuilder()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategyBuilder is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolStrategyBuilder);

        return $this;
    }
}
