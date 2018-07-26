<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Repository;

use Neighborhoods\Kojo\Process\Pool\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolRepository;

    public function setProcessPoolRepository(RepositoryInterface $processPoolRepository): self
    {
        if ($this->hasProcessPoolRepository()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolRepository is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolRepository = $processPoolRepository;

        return $this;
    }

    protected function getProcessPoolRepository(): RepositoryInterface
    {
        if (!$this->hasProcessPoolRepository()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolRepository is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolRepository;
    }

    protected function hasProcessPoolRepository(): bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolRepository);
    }

    protected function unsetProcessPoolRepository(): self
    {
        if (!$this->hasProcessPoolRepository()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolRepository is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolRepository);

        return $this;
    }
}
