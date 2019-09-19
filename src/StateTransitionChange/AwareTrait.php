<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange;

use Neighborhoods\Kojo\StateTransitionChangeInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateTransitionChange;

    public function setStateTransitionChange(StateTransitionChangeInterface $stateTransitionChange) : self
    {
        if ($this->hasStateTransitionChange()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChange is already set.');
        }
        $this->NeighborhoodsKojoStateTransitionChange = $stateTransitionChange;

        return $this;
    }

    protected function getStateTransitionChange() : StateTransitionChangeInterface
    {
        if (!$this->hasStateTransitionChange()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChange is not set.');
        }

        return $this->NeighborhoodsKojoStateTransitionChange;
    }

    protected function hasStateTransitionChange() : bool
    {
        return isset($this->NeighborhoodsKojoStateTransitionChange);
    }

    protected function unsetStateTransitionChange() : self
    {
        if (!$this->hasStateTransitionChange()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChange is not set.');
        }
        unset($this->NeighborhoodsKojoStateTransitionChange);

        return $this;
    }
}
