<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Map;

use Neighborhoods\Kojo\JobStateChange\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobStateChangeMap;

    public function setJobStateChangeMap(MapInterface $JobStateChangeMap) : self
    {
        if ($this->hasJobStateChangeMap()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeMap is already set.');
        }
        $this->NeighborhoodsKojoJobStateChangeMap = $JobStateChangeMap;

        return $this;
    }

    protected function getJobStateChangeMap() : MapInterface
    {
        if (!$this->hasJobStateChangeMap()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeMap is not set.');
        }

        return $this->NeighborhoodsKojoJobStateChangeMap;
    }

    protected function hasJobStateChangeMap() : bool
    {
        return isset($this->NeighborhoodsKojoJobStateChangeMap);
    }

    protected function unsetJobStateChangeMap() : self
    {
        if (!$this->hasJobStateChangeMap()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeMap is not set.');
        }
        unset($this->NeighborhoodsKojoJobStateChangeMap);

        return $this;
    }
}
