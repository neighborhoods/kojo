<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Repository;

use Neighborhoods\Kojo\JobStateChange\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobStateChangeRepository;

    public function setJobStateChangeRepository(RepositoryInterface $JobStateChangeRepository) : self
    {
        if ($this->hasJobStateChangeRepository()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeRepository is already set.');
        }
        $this->NeighborhoodsKojoJobStateChangeRepository = $JobStateChangeRepository;

        return $this;
    }

    protected function getJobStateChangeRepository() : RepositoryInterface
    {
        if (!$this->hasJobStateChangeRepository()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeRepository is not set.');
        }

        return $this->NeighborhoodsKojoJobStateChangeRepository;
    }

    protected function hasJobStateChangeRepository() : bool
    {
        return isset($this->NeighborhoodsKojoJobStateChangeRepository);
    }

    protected function unsetJobStateChangeRepository() : self
    {
        if (!$this->hasJobStateChangeRepository()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeRepository is not set.');
        }
        unset($this->NeighborhoodsKojoJobStateChangeRepository);

        return $this;
    }
}
