<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Map;

use Neighborhoods\Kojo\Process\Pool\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolMap;

    public function setProcessPoolMap(MapInterface $processPoolMap): self
    {
        if ($this->hasProcessPoolMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolMap is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolMap = $processPoolMap;

        return $this;
    }

    protected function getProcessPoolMap(): MapInterface
    {
        if (!$this->hasProcessPoolMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolMap is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolMap;
    }

    protected function hasProcessPoolMap(): bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolMap);
    }

    protected function unsetProcessPoolMap(): self
    {
        if (!$this->hasProcessPoolMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolMap is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolMap);

        return $this;
    }
}
