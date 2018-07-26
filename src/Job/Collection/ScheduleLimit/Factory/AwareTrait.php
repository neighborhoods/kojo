<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection\ScheduleLimit\Factory;

use Neighborhoods\Kojo\Job\Collection\ScheduleLimit\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDataJobCollectionScheduleLimitFactory;

    public function setDataJobCollectionScheduleLimitFactory(FactoryInterface $dataJobCollectionScheduleLimitFactory
    ): self {
        if ($this->hasDataJobCollectionScheduleLimitFactory()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionScheduleLimitFactory is already set.');
        }
        $this->NeighborhoodsKojoDataJobCollectionScheduleLimitFactory = $dataJobCollectionScheduleLimitFactory;

        return $this;
    }

    protected function getDataJobCollectionScheduleLimitFactory(): FactoryInterface
    {
        if (!$this->hasDataJobCollectionScheduleLimitFactory()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionScheduleLimitFactory is not set.');
        }

        return $this->NeighborhoodsKojoDataJobCollectionScheduleLimitFactory;
    }

    protected function hasDataJobCollectionScheduleLimitFactory(): bool
    {
        return isset($this->NeighborhoodsKojoDataJobCollectionScheduleLimitFactory);
    }

    protected function unsetDataJobCollectionScheduleLimitFactory(): self
    {
        if (!$this->hasDataJobCollectionScheduleLimitFactory()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionScheduleLimitFactory is not set.');
        }
        unset($this->NeighborhoodsKojoDataJobCollectionScheduleLimitFactory);

        return $this;
    }
}
