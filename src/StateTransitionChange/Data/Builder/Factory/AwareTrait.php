<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Data\Builder\Factory;

use Neighborhoods\Kojo\StateTransitionChange\Data\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateTransitionChangeDataBuilderFactory;

    public function setStateTransitionChangeDataBuilderFactory(FactoryInterface $stateTransitionChangeDataBuilderFactory) : self
    {
        if ($this->hasStateTransitionChangeDataBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeDataBuilderFactory is already set.');
        }
        $this->NeighborhoodsKojoStateTransitionChangeDataBuilderFactory = $stateTransitionChangeDataBuilderFactory;

        return $this;
    }

    protected function getStateTransitionChangeDataBuilderFactory() : FactoryInterface
    {
        if (!$this->hasStateTransitionChangeDataBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeDataBuilderFactory is not set.');
        }

        return $this->NeighborhoodsKojoStateTransitionChangeDataBuilderFactory;
    }

    protected function hasStateTransitionChangeDataBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoStateTransitionChangeDataBuilderFactory);
    }

    protected function unsetStateTransitionChangeDataBuilderFactory() : self
    {
        if (!$this->hasStateTransitionChangeDataBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeDataBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoStateTransitionChangeDataBuilderFactory);

        return $this;
    }
}
