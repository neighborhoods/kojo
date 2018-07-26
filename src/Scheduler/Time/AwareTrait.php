<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Scheduler\Time;

use Neighborhoods\Kojo\Scheduler\TimeInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSchedulerTime;

    public function setSchedulerTime(TimeInterface $schedulerTime): self
    {
        if ($this->hasSchedulerTime()) {
            throw new \LogicException('NeighborhoodsKojoSchedulerTime is already set.');
        }
        $this->NeighborhoodsKojoSchedulerTime = $schedulerTime;

        return $this;
    }

    protected function getSchedulerTime(): TimeInterface
    {
        if (!$this->hasSchedulerTime()) {
            throw new \LogicException('NeighborhoodsKojoSchedulerTime is not set.');
        }

        return $this->NeighborhoodsKojoSchedulerTime;
    }

    protected function hasSchedulerTime(): bool
    {
        return isset($this->NeighborhoodsKojoSchedulerTime);
    }

    protected function unsetSchedulerTime(): self
    {
        if (!$this->hasSchedulerTime()) {
            throw new \LogicException('NeighborhoodsKojoSchedulerTime is not set.');
        }
        unset($this->NeighborhoodsKojoSchedulerTime);

        return $this;
    }
}
