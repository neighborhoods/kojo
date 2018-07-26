<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job;

use Neighborhoods\Kojo\JobInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJob;

    public function setJob(JobInterface $job): self
    {
        if ($this->hasJob()) {
            throw new \LogicException('NeighborhoodsKojoJob is already set.');
        }
        $this->NeighborhoodsKojoJob = $job;

        return $this;
    }

    protected function getJob(): JobInterface
    {
        if (!$this->hasJob()) {
            throw new \LogicException('NeighborhoodsKojoJob is not set.');
        }

        return $this->NeighborhoodsKojoJob;
    }

    protected function hasJob(): bool
    {
        return isset($this->NeighborhoodsKojoJob);
    }

    protected function unsetJob(): self
    {
        if (!$this->hasJob()) {
            throw new \LogicException('NeighborhoodsKojoJob is not set.');
        }
        unset($this->NeighborhoodsKojoJob);

        return $this;
    }
}
