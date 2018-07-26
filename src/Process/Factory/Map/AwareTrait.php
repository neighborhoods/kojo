<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Factory\Map;

use Neighborhoods\Kojo\Process\Factory\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessFactoryMap;

    public function setProcessFactoryMap(MapInterface $processFactoryMap): self
    {
        if ($this->hasProcessFactoryMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessFactoryMap is already set.');
        }
        $this->NeighborhoodsKojoProcessFactoryMap = $processFactoryMap;

        return $this;
    }

    protected function getProcessFactoryMap(): MapInterface
    {
        if (!$this->hasProcessFactoryMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessFactoryMap is not set.');
        }

        return $this->NeighborhoodsKojoProcessFactoryMap;
    }

    protected function hasProcessFactoryMap(): bool
    {
        return isset($this->NeighborhoodsKojoProcessFactoryMap);
    }

    protected function unsetProcessFactoryMap(): self
    {
        if (!$this->hasProcessFactoryMap()) {
            throw new \LogicException('NeighborhoodsKojoProcessFactoryMap is not set.');
        }
        unset($this->NeighborhoodsKojoProcessFactoryMap);

        return $this;
    }
}
