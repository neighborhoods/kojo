<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Type\Map;

use Neighborhoods\Kojo\Job\Type\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobTypeMap;

    public function setJobTypeMap(MapInterface $jobTypeMap): self
    {
        if ($this->hasJobTypeMap()) {
            throw new \LogicException('NeighborhoodsKojoJobTypeMap is already set.');
        }
        $this->NeighborhoodsKojoJobTypeMap = $jobTypeMap;

        return $this;
    }

    protected function getJobTypeMap(): MapInterface
    {
        if (!$this->hasJobTypeMap()) {
            throw new \LogicException('NeighborhoodsKojoJobTypeMap is not set.');
        }

        return $this->NeighborhoodsKojoJobTypeMap;
    }

    protected function hasJobTypeMap(): bool
    {
        return isset($this->NeighborhoodsKojoJobTypeMap);
    }

    protected function unsetJobTypeMap(): self
    {
        if (!$this->hasJobTypeMap()) {
            throw new \LogicException('NeighborhoodsKojoJobTypeMap is not set.');
        }
        unset($this->NeighborhoodsKojoJobTypeMap);

        return $this;
    }
}
