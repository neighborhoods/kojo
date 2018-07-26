<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Repository;

use Neighborhoods\Kojo\Job\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobRepository;

    public function setJobRepository(RepositoryInterface $jobRepository): self
    {
        if ($this->hasJobRepository()) {
            throw new \LogicException('NeighborhoodsKojoJobRepository is already set.');
        }
        $this->NeighborhoodsKojoJobRepository = $jobRepository;

        return $this;
    }

    protected function getJobRepository(): RepositoryInterface
    {
        if (!$this->hasJobRepository()) {
            throw new \LogicException('NeighborhoodsKojoJobRepository is not set.');
        }

        return $this->NeighborhoodsKojoJobRepository;
    }

    protected function hasJobRepository(): bool
    {
        return isset($this->NeighborhoodsKojoJobRepository);
    }

    protected function unsetJobRepository(): self
    {
        if (!$this->hasJobRepository()) {
            throw new \LogicException('NeighborhoodsKojoJobRepository is not set.');
        }
        unset($this->NeighborhoodsKojoJobRepository);

        return $this;
    }
}
