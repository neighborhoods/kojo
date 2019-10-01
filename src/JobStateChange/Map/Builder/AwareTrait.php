<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Map\Builder;

use Neighborhoods\Kojo\JobStateChange\Map\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobStateChangeMapBuilder;

    public function setJobStateChangeMapBuilder(BuilderInterface $JobStateChangeMapBuilder) : self
    {
        if ($this->hasJobStateChangeMapBuilder()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeMapBuilder is already set.');
        }
        $this->NeighborhoodsKojoJobStateChangeMapBuilder = $JobStateChangeMapBuilder;

        return $this;
    }

    protected function getJobStateChangeMapBuilder() : BuilderInterface
    {
        if (!$this->hasJobStateChangeMapBuilder()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeMapBuilder is not set.');
        }

        return $this->NeighborhoodsKojoJobStateChangeMapBuilder;
    }

    protected function hasJobStateChangeMapBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoJobStateChangeMapBuilder);
    }

    protected function unsetJobStateChangeMapBuilder() : self
    {
        if (!$this->hasJobStateChangeMapBuilder()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeMapBuilder is not set.');
        }
        unset($this->NeighborhoodsKojoJobStateChangeMapBuilder);

        return $this;
    }
}
