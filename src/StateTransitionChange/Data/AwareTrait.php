<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Data;

use Neighborhoods\Kojo\StateTransitionChange\DataInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateTransitionChangeData;

    public function setStateTransitionChangeData(DataInterface $stateTransitionChangeData) : self
    {
        if ($this->hasStateTransitionChangeData()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeData is already set.');
        }
        $this->NeighborhoodsKojoStateTransitionChangeData = $stateTransitionChangeData;

        return $this;
    }

    protected function getStateTransitionChangeData() : DataInterface
    {
        if (!$this->hasStateTransitionChangeData()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeData is not set.');
        }

        return $this->NeighborhoodsKojoStateTransitionChangeData;
    }

    protected function hasStateTransitionChangeData() : bool
    {
        return isset($this->NeighborhoodsKojoStateTransitionChangeData);
    }

    protected function unsetStateTransitionChangeData() : self
    {
        if (!$this->hasStateTransitionChangeData()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeData is not set.');
        }
        unset($this->NeighborhoodsKojoStateTransitionChangeData);

        return $this;
    }
}
