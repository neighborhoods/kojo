<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection\Scheduler;

use Neighborhoods\Kojo\Job\Collection\SchedulerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDataJobCollectionScheduler;

    public function setDataJobCollectionScheduler(SchedulerInterface $dataJobCollectionScheduler): self
    {
        if ($this->hasDataJobCollectionScheduler()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionScheduler is already set.');
        }
        $this->NeighborhoodsKojoDataJobCollectionScheduler = $dataJobCollectionScheduler;

        return $this;
    }

    protected function getDataJobCollectionScheduler(): SchedulerInterface
    {
        if (!$this->hasDataJobCollectionScheduler()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionScheduler is not set.');
        }

        return $this->NeighborhoodsKojoDataJobCollectionScheduler;
    }

    protected function hasDataJobCollectionScheduler(): bool
    {
        return isset($this->NeighborhoodsKojoDataJobCollectionScheduler);
    }

    protected function unsetDataJobCollectionScheduler(): self
    {
        if (!$this->hasDataJobCollectionScheduler()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionScheduler is not set.');
        }
        unset($this->NeighborhoodsKojoDataJobCollectionScheduler);

        return $this;
    }
}
