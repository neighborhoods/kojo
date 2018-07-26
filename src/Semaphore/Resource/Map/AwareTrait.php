<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Map;

use Neighborhoods\Kojo\Semaphore\Resource\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSemaphoreResourceMap;

    public function setSemaphoreResourceMap(MapInterface $semaphoreResourceMap): self
    {
        if ($this->hasSemaphoreResourceMap()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceMap is already set.');
        }
        $this->NeighborhoodsKojoSemaphoreResourceMap = $semaphoreResourceMap;

        return $this;
    }

    protected function getSemaphoreResourceMap(): MapInterface
    {
        if (!$this->hasSemaphoreResourceMap()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceMap is not set.');
        }

        return $this->NeighborhoodsKojoSemaphoreResourceMap;
    }

    protected function hasSemaphoreResourceMap(): bool
    {
        return isset($this->NeighborhoodsKojoSemaphoreResourceMap);
    }

    protected function unsetSemaphoreResourceMap(): self
    {
        if (!$this->hasSemaphoreResourceMap()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceMap is not set.');
        }
        unset($this->NeighborhoodsKojoSemaphoreResourceMap);

        return $this;
    }
}
