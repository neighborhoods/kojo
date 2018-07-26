<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Owner\Job;

use Neighborhoods\Kojo\Semaphore\Resource\Owner\JobInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSemaphoreResourceOwnerJob;

    public function setSemaphoreResourceOwnerJob(JobInterface $semaphoreResourceOwnerJob): self
    {
        if ($this->hasSemaphoreResourceOwnerJob()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceOwnerJob is already set.');
        }
        $this->NeighborhoodsKojoSemaphoreResourceOwnerJob = $semaphoreResourceOwnerJob;

        return $this;
    }

    protected function getSemaphoreResourceOwnerJob(): JobInterface
    {
        if (!$this->hasSemaphoreResourceOwnerJob()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceOwnerJob is not set.');
        }

        return $this->NeighborhoodsKojoSemaphoreResourceOwnerJob;
    }

    protected function hasSemaphoreResourceOwnerJob(): bool
    {
        return isset($this->NeighborhoodsKojoSemaphoreResourceOwnerJob);
    }

    protected function unsetSemaphoreResourceOwnerJob(): self
    {
        if (!$this->hasSemaphoreResourceOwnerJob()) {
            throw new \LogicException('NeighborhoodsKojoSemaphoreResourceOwnerJob is not set.');
        }
        unset($this->NeighborhoodsKojoSemaphoreResourceOwnerJob);

        return $this;
    }
}
