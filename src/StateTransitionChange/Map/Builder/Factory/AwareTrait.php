<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Map\Builder\Factory;

use Neighborhoods\Kojo\StateTransitionChange\Map\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateTransitionChangeMapBuilderFactory;

    public function setStateTransitionChangeMapBuilderFactory(FactoryInterface $stateTransitionChangeMapBuilderFactory) : self
    {
        if ($this->hasStateTransitionChangeMapBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeMapBuilderFactory is already set.');
        }
        $this->NeighborhoodsKojoStateTransitionChangeMapBuilderFactory = $stateTransitionChangeMapBuilderFactory;

        return $this;
    }

    protected function getStateTransitionChangeMapBuilderFactory() : FactoryInterface
    {
        if (!$this->hasStateTransitionChangeMapBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeMapBuilderFactory is not set.');
        }

        return $this->NeighborhoodsKojoStateTransitionChangeMapBuilderFactory;
    }

    protected function hasStateTransitionChangeMapBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoStateTransitionChangeMapBuilderFactory);
    }

    protected function unsetStateTransitionChangeMapBuilderFactory() : self
    {
        if (!$this->hasStateTransitionChangeMapBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeMapBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoStateTransitionChangeMapBuilderFactory);

        return $this;
    }
}
