<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Type\Collection\Scheduler;

use Neighborhoods\Kojo\Job\Type\Collection\SchedulerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDataJobTypeCollectionScheduler;

    public function setDataJobTypeCollectionScheduler(SchedulerInterface $dataJobTypeCollectionScheduler): self
    {
        if ($this->hasDataJobTypeCollectionScheduler()) {
            throw new \LogicException('NeighborhoodsKojoDataJobTypeCollectionScheduler is already set.');
        }
        $this->NeighborhoodsKojoDataJobTypeCollectionScheduler = $dataJobTypeCollectionScheduler;

        return $this;
    }

    protected function getDataJobTypeCollectionScheduler(): SchedulerInterface
    {
        if (!$this->hasDataJobTypeCollectionScheduler()) {
            throw new \LogicException('NeighborhoodsKojoDataJobTypeCollectionScheduler is not set.');
        }

        return $this->NeighborhoodsKojoDataJobTypeCollectionScheduler;
    }

    protected function hasDataJobTypeCollectionScheduler(): bool
    {
        return isset($this->NeighborhoodsKojoDataJobTypeCollectionScheduler);
    }

    protected function unsetDataJobTypeCollectionScheduler(): self
    {
        if (!$this->hasDataJobTypeCollectionScheduler()) {
            throw new \LogicException('NeighborhoodsKojoDataJobTypeCollectionScheduler is not set.');
        }
        unset($this->NeighborhoodsKojoDataJobTypeCollectionScheduler);

        return $this;
    }
}
