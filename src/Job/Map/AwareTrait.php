<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Map;

use Neighborhoods\Kojo\Job\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobMap;

    public function setJobMap(MapInterface $jobMap): self
    {
        if ($this->hasJobMap()) {
            throw new \LogicException('NeighborhoodsKojoJobMap is already set.');
        }
        $this->NeighborhoodsKojoJobMap = $jobMap;

        return $this;
    }

    protected function getJobMap(): MapInterface
    {
        if (!$this->hasJobMap()) {
            throw new \LogicException('NeighborhoodsKojoJobMap is not set.');
        }

        return $this->NeighborhoodsKojoJobMap;
    }

    protected function hasJobMap(): bool
    {
        return isset($this->NeighborhoodsKojoJobMap);
    }

    protected function unsetJobMap(): self
    {
        if (!$this->hasJobMap()) {
            throw new \LogicException('NeighborhoodsKojoJobMap is not set.');
        }
        unset($this->NeighborhoodsKojoJobMap);

        return $this;
    }
}
