<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Map;

use Neighborhoods\Kojo\StateTransitionChange\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateTransitionChangeMap;

    public function setStateTransitionChangeMap(MapInterface $stateTransitionChangeMap) : self
    {
        if ($this->hasStateTransitionChangeMap()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeMap is already set.');
        }
        $this->NeighborhoodsKojoStateTransitionChangeMap = $stateTransitionChangeMap;

        return $this;
    }

    protected function getStateTransitionChangeMap() : MapInterface
    {
        if (!$this->hasStateTransitionChangeMap()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeMap is not set.');
        }

        return $this->NeighborhoodsKojoStateTransitionChangeMap;
    }

    protected function hasStateTransitionChangeMap() : bool
    {
        return isset($this->NeighborhoodsKojoStateTransitionChangeMap);
    }

    protected function unsetStateTransitionChangeMap() : self
    {
        if (!$this->hasStateTransitionChangeMap()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeMap is not set.');
        }
        unset($this->NeighborhoodsKojoStateTransitionChangeMap);

        return $this;
    }
}
