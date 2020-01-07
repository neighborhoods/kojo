<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Data\Factory;

use Neighborhoods\Kojo\JobStateChange\Data\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobStateChangeDataFactory;

    public function setJobStateChangeDataFactory(FactoryInterface $JobStateChangeDataFactory) : self
    {
        if ($this->hasJobStateChangeDataFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeDataFactory is already set.');
        }
        $this->NeighborhoodsKojoJobStateChangeDataFactory = $JobStateChangeDataFactory;

        return $this;
    }

    protected function getJobStateChangeDataFactory() : FactoryInterface
    {
        if (!$this->hasJobStateChangeDataFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeDataFactory is not set.');
        }

        return $this->NeighborhoodsKojoJobStateChangeDataFactory;
    }

    protected function hasJobStateChangeDataFactory() : bool
    {
        return isset($this->NeighborhoodsKojoJobStateChangeDataFactory);
    }

    protected function unsetJobStateChangeDataFactory() : self
    {
        if (!$this->hasJobStateChangeDataFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeDataFactory is not set.');
        }
        unset($this->NeighborhoodsKojoJobStateChangeDataFactory);

        return $this;
    }
}
