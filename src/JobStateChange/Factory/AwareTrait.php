<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Factory;

use Neighborhoods\Kojo\JobStateChange\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobStateChangeFactory;

    public function setJobStateChangeFactory(FactoryInterface $JobStateChangeFactory) : self
    {
        if ($this->hasJobStateChangeFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeFactory is already set.');
        }
        $this->NeighborhoodsKojoJobStateChangeFactory = $JobStateChangeFactory;

        return $this;
    }

    protected function getJobStateChangeFactory() : FactoryInterface
    {
        if (!$this->hasJobStateChangeFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeFactory is not set.');
        }

        return $this->NeighborhoodsKojoJobStateChangeFactory;
    }

    protected function hasJobStateChangeFactory() : bool
    {
        return isset($this->NeighborhoodsKojoJobStateChangeFactory);
    }

    protected function unsetJobStateChangeFactory() : self
    {
        if (!$this->hasJobStateChangeFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeFactory is not set.');
        }
        unset($this->NeighborhoodsKojoJobStateChangeFactory);

        return $this;
    }
}
