<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Builder;

use Neighborhoods\Kojo\JobStateChange\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobStateChangeBuilder;

    public function setJobStateChangeBuilder(BuilderInterface $JobStateChangeBuilder) : self
    {
        if ($this->hasJobStateChangeBuilder()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeBuilder is already set.');
        }
        $this->NeighborhoodsKojoJobStateChangeBuilder = $JobStateChangeBuilder;

        return $this;
    }

    protected function getJobStateChangeBuilder() : BuilderInterface
    {
        if (!$this->hasJobStateChangeBuilder()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeBuilder is not set.');
        }

        return $this->NeighborhoodsKojoJobStateChangeBuilder;
    }

    protected function hasJobStateChangeBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoJobStateChangeBuilder);
    }

    protected function unsetJobStateChangeBuilder() : self
    {
        if (!$this->hasJobStateChangeBuilder()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeBuilder is not set.');
        }
        unset($this->NeighborhoodsKojoJobStateChangeBuilder);

        return $this;
    }
}
