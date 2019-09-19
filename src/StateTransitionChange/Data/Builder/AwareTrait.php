<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Data\Builder;

use Neighborhoods\Kojo\StateTransitionChange\Data\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateTransitionChangeDataBuilder;

    public function setStateTransitionChangeDataBuilder(BuilderInterface $stateTransitionChangeDataBuilder) : self
    {
        if ($this->hasStateTransitionChangeDataBuilder()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeDataBuilder is already set.');
        }
        $this->NeighborhoodsKojoStateTransitionChangeDataBuilder = $stateTransitionChangeDataBuilder;

        return $this;
    }

    protected function getStateTransitionChangeDataBuilder() : BuilderInterface
    {
        if (!$this->hasStateTransitionChangeDataBuilder()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeDataBuilder is not set.');
        }

        return $this->NeighborhoodsKojoStateTransitionChangeDataBuilder;
    }

    protected function hasStateTransitionChangeDataBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoStateTransitionChangeDataBuilder);
    }

    protected function unsetStateTransitionChangeDataBuilder() : self
    {
        if (!$this->hasStateTransitionChangeDataBuilder()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeDataBuilder is not set.');
        }
        unset($this->NeighborhoodsKojoStateTransitionChangeDataBuilder);

        return $this;
    }
}
