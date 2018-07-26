<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Scheduler;

use Neighborhoods\Kojo\SchedulerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoScheduler;

    public function setScheduler(SchedulerInterface $scheduler): self
    {
        if ($this->hasScheduler()) {
            throw new \LogicException('NeighborhoodsKojoScheduler is already set.');
        }
        $this->NeighborhoodsKojoScheduler = $scheduler;

        return $this;
    }

    protected function getScheduler(): SchedulerInterface
    {
        if (!$this->hasScheduler()) {
            throw new \LogicException('NeighborhoodsKojoScheduler is not set.');
        }

        return $this->NeighborhoodsKojoScheduler;
    }

    protected function hasScheduler(): bool
    {
        return isset($this->NeighborhoodsKojoScheduler);
    }

    protected function unsetScheduler(): self
    {
        if (!$this->hasScheduler()) {
            throw new \LogicException('NeighborhoodsKojoScheduler is not set.');
        }
        unset($this->NeighborhoodsKojoScheduler);

        return $this;
    }
}
