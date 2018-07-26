<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Type\Repository;

use Neighborhoods\Kojo\Job\Type\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobTypeRepository;

    public function setJobTypeRepository(RepositoryInterface $jobTypeRepository): self
    {
        if ($this->hasJobTypeRepository()) {
            throw new \LogicException('NeighborhoodsKojoJobTypeRepository is already set.');
        }
        $this->NeighborhoodsKojoJobTypeRepository = $jobTypeRepository;

        return $this;
    }

    protected function getJobTypeRepository(): RepositoryInterface
    {
        if (!$this->hasJobTypeRepository()) {
            throw new \LogicException('NeighborhoodsKojoJobTypeRepository is not set.');
        }

        return $this->NeighborhoodsKojoJobTypeRepository;
    }

    protected function hasJobTypeRepository(): bool
    {
        return isset($this->NeighborhoodsKojoJobTypeRepository);
    }

    protected function unsetJobTypeRepository(): self
    {
        if (!$this->hasJobTypeRepository()) {
            throw new \LogicException('NeighborhoodsKojoJobTypeRepository is not set.');
        }
        unset($this->NeighborhoodsKojoJobTypeRepository);

        return $this;
    }
}
