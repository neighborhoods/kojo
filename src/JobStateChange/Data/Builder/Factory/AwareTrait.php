<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Data\Builder\Factory;

use Neighborhoods\Kojo\JobStateChange\Data\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobStateChangeDataBuilderFactory;

    public function setJobStateChangeDataBuilderFactory(FactoryInterface $JobStateChangeDataBuilderFactory) : self
    {
        if ($this->hasJobStateChangeDataBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeDataBuilderFactory is already set.');
        }
        $this->NeighborhoodsKojoJobStateChangeDataBuilderFactory = $JobStateChangeDataBuilderFactory;

        return $this;
    }

    protected function getJobStateChangeDataBuilderFactory() : FactoryInterface
    {
        if (!$this->hasJobStateChangeDataBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeDataBuilderFactory is not set.');
        }

        return $this->NeighborhoodsKojoJobStateChangeDataBuilderFactory;
    }

    protected function hasJobStateChangeDataBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoJobStateChangeDataBuilderFactory);
    }

    protected function unsetJobStateChangeDataBuilderFactory() : self
    {
        if (!$this->hasJobStateChangeDataBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeDataBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoJobStateChangeDataBuilderFactory);

        return $this;
    }
}
