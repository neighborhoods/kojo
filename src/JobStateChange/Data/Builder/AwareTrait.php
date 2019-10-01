<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Data\Builder;

use Neighborhoods\Kojo\JobStateChange\Data\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobStateChangeDataBuilder;

    public function setJobStateChangeDataBuilder(BuilderInterface $JobStateChangeDataBuilder) : self
    {
        if ($this->hasJobStateChangeDataBuilder()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeDataBuilder is already set.');
        }
        $this->NeighborhoodsKojoJobStateChangeDataBuilder = $JobStateChangeDataBuilder;

        return $this;
    }

    protected function getJobStateChangeDataBuilder() : BuilderInterface
    {
        if (!$this->hasJobStateChangeDataBuilder()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeDataBuilder is not set.');
        }

        return $this->NeighborhoodsKojoJobStateChangeDataBuilder;
    }

    protected function hasJobStateChangeDataBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoJobStateChangeDataBuilder);
    }

    protected function unsetJobStateChangeDataBuilder() : self
    {
        if (!$this->hasJobStateChangeDataBuilder()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeDataBuilder is not set.');
        }
        unset($this->NeighborhoodsKojoJobStateChangeDataBuilder);

        return $this;
    }
}
