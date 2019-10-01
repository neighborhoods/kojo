<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Builder\Factory;

use Neighborhoods\Kojo\JobStateChange\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobStateChangeBuilderFactory;

    public function setJobStateChangeBuilderFactory(FactoryInterface $JobStateChangeBuilderFactory) : self
    {
        if ($this->hasJobStateChangeBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeBuilderFactory is already set.');
        }
        $this->NeighborhoodsKojoJobStateChangeBuilderFactory = $JobStateChangeBuilderFactory;

        return $this;
    }

    protected function getJobStateChangeBuilderFactory() : FactoryInterface
    {
        if (!$this->hasJobStateChangeBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeBuilderFactory is not set.');
        }

        return $this->NeighborhoodsKojoJobStateChangeBuilderFactory;
    }

    protected function hasJobStateChangeBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoJobStateChangeBuilderFactory);
    }

    protected function unsetJobStateChangeBuilderFactory() : self
    {
        if (!$this->hasJobStateChangeBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoJobStateChangeBuilderFactory);

        return $this;
    }
}
