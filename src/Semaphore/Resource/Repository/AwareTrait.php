<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Repository;

use Neighborhoods\Kojo\Semaphore\Resource\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSemaphoreResourceRepository;

    public function setSemaphoreResourceRepository(RepositoryInterface $semaphoreResourceRepository): self
    {
        if ($this->hasSemaphoreResourceRepository()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceRepository is already set.');
        }
        $this->NeighborhoodsKojoSemaphoreResourceRepository = $semaphoreResourceRepository;

        return $this;
    }

    protected function getSemaphoreResourceRepository(): RepositoryInterface
    {
        if (!$this->hasSemaphoreResourceRepository()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceRepository is not set.');
        }

        return $this->NeighborhoodsKojoSemaphoreResourceRepository;
    }

    protected function hasSemaphoreResourceRepository(): bool
    {
        return isset($this->NeighborhoodsKojoSemaphoreResourceRepository);
    }

    protected function unsetSemaphoreResourceRepository(): self
    {
        if (!$this->hasSemaphoreResourceRepository()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceRepository is not set.');
        }
        unset($this->NeighborhoodsKojoSemaphoreResourceRepository);

        return $this;
    }
}
