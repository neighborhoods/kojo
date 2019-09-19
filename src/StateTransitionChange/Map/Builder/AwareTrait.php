<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Map\Builder;

use Neighborhoods\Kojo\StateTransitionChange\Map\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateTransitionChangeMapBuilder;

    public function setStateTransitionChangeMapBuilder(BuilderInterface $stateTransitionChangeMapBuilder) : self
    {
        if ($this->hasStateTransitionChangeMapBuilder()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeMapBuilder is already set.');
        }
        $this->NeighborhoodsKojoStateTransitionChangeMapBuilder = $stateTransitionChangeMapBuilder;

        return $this;
    }

    protected function getStateTransitionChangeMapBuilder() : BuilderInterface
    {
        if (!$this->hasStateTransitionChangeMapBuilder()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeMapBuilder is not set.');
        }

        return $this->NeighborhoodsKojoStateTransitionChangeMapBuilder;
    }

    protected function hasStateTransitionChangeMapBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoStateTransitionChangeMapBuilder);
    }

    protected function unsetStateTransitionChangeMapBuilder() : self
    {
        if (!$this->hasStateTransitionChangeMapBuilder()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeMapBuilder is not set.');
        }
        unset($this->NeighborhoodsKojoStateTransitionChangeMapBuilder);

        return $this;
    }
}
