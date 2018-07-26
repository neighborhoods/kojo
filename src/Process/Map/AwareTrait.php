<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Map;

use Neighborhoods\Kojo\Process\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessMap;

    public function setProcessMap(MapInterface $processMap): self
    {
        if ($this->hasProcessMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessMap is already set.');
        }
        $this->NeighborhoodsKojoProcessMap = $processMap;

        return $this;
    }

    protected function getProcessMap(): MapInterface
    {
        if (!$this->hasProcessMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessMap is not set.');
        }

        return $this->NeighborhoodsKojoProcessMap;
    }

    protected function hasProcessMap(): bool
    {
        return isset($this->NeighborhoodsKojoProcessMap);
    }

    protected function unsetProcessMap(): self
    {
        if (!$this->hasProcessMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessMap is not set.');
        }
        unset($this->NeighborhoodsKojoProcessMap);

        return $this;
    }
}
