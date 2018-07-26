<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection\ScheduleLimit;

use Neighborhoods\Kojo\Job\Collection\ScheduleLimitInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDataJobCollectionScheduleLimit;

    public function setDataJobCollectionScheduleLimit(ScheduleLimitInterface $dataJobCollectionScheduleLimit): self
    {
        if ($this->hasDataJobCollectionScheduleLimit()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionScheduleLimit is already set.');
        }
        $this->NeighborhoodsKojoDataJobCollectionScheduleLimit = $dataJobCollectionScheduleLimit;

        return $this;
    }

    protected function getDataJobCollectionScheduleLimit(): ScheduleLimitInterface
    {
        if (!$this->hasDataJobCollectionScheduleLimit()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionScheduleLimit is not set.');
        }

        return $this->NeighborhoodsKojoDataJobCollectionScheduleLimit;
    }

    protected function hasDataJobCollectionScheduleLimit(): bool
    {
        return isset($this->NeighborhoodsKojoDataJobCollectionScheduleLimit);
    }

    protected function unsetDataJobCollectionScheduleLimit(): self
    {
        if (!$this->hasDataJobCollectionScheduleLimit()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionScheduleLimit is not set.');
        }
        unset($this->NeighborhoodsKojoDataJobCollectionScheduleLimit);

        return $this;
    }
}
