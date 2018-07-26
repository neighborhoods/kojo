<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Repository;

use Neighborhoods\Kojo\Process\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessRepository;

    public function setProcessRepository(RepositoryInterface $processRepository): self
    {
        if ($this->hasProcessRepository()) {
            throw new \LogicException('NeighborhoodsKojoProcessRepository is already set.');
        }
        $this->NeighborhoodsKojoProcessRepository = $processRepository;

        return $this;
    }

    protected function getProcessRepository(): RepositoryInterface
    {
        if (!$this->hasProcessRepository()) {
            throw new \LogicException('NeighborhoodsKojoProcessRepository is not set.');
        }

        return $this->NeighborhoodsKojoProcessRepository;
    }

    protected function hasProcessRepository(): bool
    {
        return isset($this->NeighborhoodsKojoProcessRepository);
    }

    protected function unsetProcessRepository(): self
    {
        if (!$this->hasProcessRepository()) {
            throw new \LogicException('NeighborhoodsKojoProcessRepository is not set.');
        }
        unset($this->NeighborhoodsKojoProcessRepository);

        return $this;
    }
}
