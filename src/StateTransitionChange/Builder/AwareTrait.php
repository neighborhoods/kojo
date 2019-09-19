<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Builder;

use Neighborhoods\Kojo\StateTransitionChange\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateTransitionChangeBuilder;

    public function setStateTransitionChangeBuilder(BuilderInterface $stateTransitionChangeBuilder) : self
    {
        if ($this->hasStateTransitionChangeBuilder()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeBuilder is already set.');
        }
        $this->NeighborhoodsKojoStateTransitionChangeBuilder = $stateTransitionChangeBuilder;

        return $this;
    }

    protected function getStateTransitionChangeBuilder() : BuilderInterface
    {
        if (!$this->hasStateTransitionChangeBuilder()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeBuilder is not set.');
        }

        return $this->NeighborhoodsKojoStateTransitionChangeBuilder;
    }

    protected function hasStateTransitionChangeBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoStateTransitionChangeBuilder);
    }

    protected function unsetStateTransitionChangeBuilder() : self
    {
        if (!$this->hasStateTransitionChangeBuilder()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeBuilder is not set.');
        }
        unset($this->NeighborhoodsKojoStateTransitionChangeBuilder);

        return $this;
    }
}
