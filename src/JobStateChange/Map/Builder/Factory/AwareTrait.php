<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Map\Builder\Factory;

use Neighborhoods\Kojo\JobStateChange\Map\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobStateChangeMapBuilderFactory;

    public function setJobStateChangeMapBuilderFactory(FactoryInterface $JobStateChangeMapBuilderFactory) : self
    {
        if ($this->hasJobStateChangeMapBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeMapBuilderFactory is already set.');
        }
        $this->NeighborhoodsKojoJobStateChangeMapBuilderFactory = $JobStateChangeMapBuilderFactory;

        return $this;
    }

    protected function getJobStateChangeMapBuilderFactory() : FactoryInterface
    {
        if (!$this->hasJobStateChangeMapBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeMapBuilderFactory is not set.');
        }

        return $this->NeighborhoodsKojoJobStateChangeMapBuilderFactory;
    }

    protected function hasJobStateChangeMapBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoJobStateChangeMapBuilderFactory);
    }

    protected function unsetJobStateChangeMapBuilderFactory() : self
    {
        if (!$this->hasJobStateChangeMapBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeMapBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoJobStateChangeMapBuilderFactory);

        return $this;
    }
}
