<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy\Repository;

use Neighborhoods\Kojo\Process\Pool\Strategy\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolStrategyRepository;

    public function setProcessPoolStrategyRepository(RepositoryInterface $processPoolStrategyRepository): self
    {
        if ($this->hasProcessPoolStrategyRepository()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategyRepository is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolStrategyRepository = $processPoolStrategyRepository;

        return $this;
    }

    protected function getProcessPoolStrategyRepository(): RepositoryInterface
    {
        if (!$this->hasProcessPoolStrategyRepository()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategyRepository is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolStrategyRepository;
    }

    protected function hasProcessPoolStrategyRepository(): bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolStrategyRepository);
    }

    protected function unsetProcessPoolStrategyRepository(): self
    {
        if (!$this->hasProcessPoolStrategyRepository()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolStrategyRepository is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolStrategyRepository);

        return $this;
    }
}
