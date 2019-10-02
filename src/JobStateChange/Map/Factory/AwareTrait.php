<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Map\Factory;

use Neighborhoods\Kojo\JobStateChange\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobStateChangeMapFactory;

    public function setJobStateChangeMapFactory(FactoryInterface $JobStateChangeMapFactory) : self
    {
        if ($this->hasJobStateChangeMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeMapFactory is already set.');
        }
        $this->NeighborhoodsKojoJobStateChangeMapFactory = $JobStateChangeMapFactory;

        return $this;
    }

    protected function getJobStateChangeMapFactory() : FactoryInterface
    {
        if (!$this->hasJobStateChangeMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeMapFactory is not set.');
        }

        return $this->NeighborhoodsKojoJobStateChangeMapFactory;
    }

    protected function hasJobStateChangeMapFactory() : bool
    {
        return isset($this->NeighborhoodsKojoJobStateChangeMapFactory);
    }

    protected function unsetJobStateChangeMapFactory() : self
    {
        if (!$this->hasJobStateChangeMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeMapFactory is not set.');
        }
        unset($this->NeighborhoodsKojoJobStateChangeMapFactory);

        return $this;
    }
}
