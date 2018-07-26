<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy\Builder\Map;

use Neighborhoods\Kojo\Process\Pool\Strategy\Builder\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolStrategyBuilderMap;

    public function setProcessPoolStrategyBuilderMap(MapInterface $processPoolStrategyBuilderMap): self
    {
        if ($this->hasProcessPoolStrategyBuilderMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategyBuilderMap is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolStrategyBuilderMap = $processPoolStrategyBuilderMap;

        return $this;
    }

    protected function getProcessPoolStrategyBuilderMap(): MapInterface
    {
        if (!$this->hasProcessPoolStrategyBuilderMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategyBuilderMap is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolStrategyBuilderMap;
    }

    protected function hasProcessPoolStrategyBuilderMap(): bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolStrategyBuilderMap);
    }

    protected function unsetProcessPoolStrategyBuilderMap(): self
    {
        if (!$this->hasProcessPoolStrategyBuilderMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategyBuilderMap is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolStrategyBuilderMap);

        return $this;
    }
}
