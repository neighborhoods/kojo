<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Repository;

use Neighborhoods\Kojo\StateTransitionChange\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateTransitionChangeRepository;

    public function setStateTransitionChangeRepository(RepositoryInterface $stateTransitionChangeRepository) : self
    {
        if ($this->hasStateTransitionChangeRepository()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeRepository is already set.');
        }
        $this->NeighborhoodsKojoStateTransitionChangeRepository = $stateTransitionChangeRepository;

        return $this;
    }

    protected function getStateTransitionChangeRepository() : RepositoryInterface
    {
        if (!$this->hasStateTransitionChangeRepository()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeRepository is not set.');
        }

        return $this->NeighborhoodsKojoStateTransitionChangeRepository;
    }

    protected function hasStateTransitionChangeRepository() : bool
    {
        return isset($this->NeighborhoodsKojoStateTransitionChangeRepository);
    }

    protected function unsetStateTransitionChangeRepository() : self
    {
        if (!$this->hasStateTransitionChangeRepository()) {
            throw new \LogicException('NeighborhoodsKojoStateTransitionChangeRepository is not set.');
        }
        unset($this->NeighborhoodsKojoStateTransitionChangeRepository);

        return $this;
    }
}
