<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Map\Factory;

use Neighborhoods\Kojo\StateTransitionChange\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateTransitionChangeMapFactory;

    public function setStateTransitionChangeMapFactory(FactoryInterface $stateTransitionChangeMapFactory) : self
    {
        if ($this->hasStateTransitionChangeMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeMapFactory is already set.');
        }
        $this->NeighborhoodsKojoStateTransitionChangeMapFactory = $stateTransitionChangeMapFactory;

        return $this;
    }

    protected function getStateTransitionChangeMapFactory() : FactoryInterface
    {
        if (!$this->hasStateTransitionChangeMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeMapFactory is not set.');
        }

        return $this->NeighborhoodsKojoStateTransitionChangeMapFactory;
    }

    protected function hasStateTransitionChangeMapFactory() : bool
    {
        return isset($this->NeighborhoodsKojoStateTransitionChangeMapFactory);
    }

    protected function unsetStateTransitionChangeMapFactory() : self
    {
        if (!$this->hasStateTransitionChangeMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeMapFactory is not set.');
        }
        unset($this->NeighborhoodsKojoStateTransitionChangeMapFactory);

        return $this;
    }
}
