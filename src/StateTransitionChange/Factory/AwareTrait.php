<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Factory;

use Neighborhoods\Kojo\StateTransitionChange\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateTransitionChangeFactory;

    public function setStateTransitionChangeFactory(FactoryInterface $stateTransitionChangeFactory) : self
    {
        if ($this->hasStateTransitionChangeFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeFactory is already set.');
        }
        $this->NeighborhoodsKojoStateTransitionChangeFactory = $stateTransitionChangeFactory;

        return $this;
    }

    protected function getStateTransitionChangeFactory() : FactoryInterface
    {
        if (!$this->hasStateTransitionChangeFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeFactory is not set.');
        }

        return $this->NeighborhoodsKojoStateTransitionChangeFactory;
    }

    protected function hasStateTransitionChangeFactory() : bool
    {
        return isset($this->NeighborhoodsKojoStateTransitionChangeFactory);
    }

    protected function unsetStateTransitionChangeFactory() : self
    {
        if (!$this->hasStateTransitionChangeFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeFactory is not set.');
        }
        unset($this->NeighborhoodsKojoStateTransitionChangeFactory);

        return $this;
    }
}
