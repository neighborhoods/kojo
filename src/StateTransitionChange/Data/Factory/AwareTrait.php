<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Data\Factory;

use Neighborhoods\Kojo\StateTransitionChange\Data\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateTransitionChangeDataFactory;

    public function setStateTransitionChangeDataFactory(FactoryInterface $stateTransitionChangeDataFactory) : self
    {
        if ($this->hasStateTransitionChangeDataFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeDataFactory is already set.');
        }
        $this->NeighborhoodsKojoStateTransitionChangeDataFactory = $stateTransitionChangeDataFactory;

        return $this;
    }

    protected function getStateTransitionChangeDataFactory() : FactoryInterface
    {
        if (!$this->hasStateTransitionChangeDataFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeDataFactory is not set.');
        }

        return $this->NeighborhoodsKojoStateTransitionChangeDataFactory;
    }

    protected function hasStateTransitionChangeDataFactory() : bool
    {
        return isset($this->NeighborhoodsKojoStateTransitionChangeDataFactory);
    }

    protected function unsetStateTransitionChangeDataFactory() : self
    {
        if (!$this->hasStateTransitionChangeDataFactory()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeDataFactory is not set.');
        }
        unset($this->NeighborhoodsKojoStateTransitionChangeDataFactory);

        return $this;
    }
}
