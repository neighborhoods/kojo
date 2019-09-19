<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Builder\Factory;

use Neighborhoods\Kojo\StateTransitionChange\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateTransitionChangeBuilderFactory;

    public function setStateTransitionChangeBuilderFactory(FactoryInterface $stateTransitionChangeBuilderFactory) : self
    {
        if ($this->hasStateTransitionChangeBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeBuilderFactory is already set.');
        }
        $this->NeighborhoodsKojoStateTransitionChangeBuilderFactory = $stateTransitionChangeBuilderFactory;

        return $this;
    }

    protected function getStateTransitionChangeBuilderFactory() : FactoryInterface
    {
        if (!$this->hasStateTransitionChangeBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeBuilderFactory is not set.');
        }

        return $this->NeighborhoodsKojoStateTransitionChangeBuilderFactory;
    }

    protected function hasStateTransitionChangeBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoStateTransitionChangeBuilderFactory);
    }

    protected function unsetStateTransitionChangeBuilderFactory() : self
    {
        if (!$this->hasStateTransitionChangeBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoStateTransitionChangeBuilderFactory);

        return $this;
    }
}
