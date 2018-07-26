<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection\Schedule\LimitCheck;

use Neighborhoods\Kojo\Job\Collection\Schedule\LimitCheckInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDataJobCollectionScheduleLimitCheck;

    public function setDataJobCollectionScheduleLimitCheck(LimitCheckInterface $dataJobCollectionScheduleLimitCheck
    ): self {
        if ($this->hasDataJobCollectionScheduleLimitCheck()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionScheduleLimitCheck is already set.');
        }
        $this->NeighborhoodsKojoDataJobCollectionScheduleLimitCheck = $dataJobCollectionScheduleLimitCheck;

        return $this;
    }

    protected function getDataJobCollectionScheduleLimitCheck(): LimitCheckInterface
    {
        if (!$this->hasDataJobCollectionScheduleLimitCheck()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionScheduleLimitCheck is not set.');
        }

        return $this->NeighborhoodsKojoDataJobCollectionScheduleLimitCheck;
    }

    protected function hasDataJobCollectionScheduleLimitCheck(): bool
    {
        return isset($this->NeighborhoodsKojoDataJobCollectionScheduleLimitCheck);
    }

    protected function unsetDataJobCollectionScheduleLimitCheck(): self
    {
        if (!$this->hasDataJobCollectionScheduleLimitCheck()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionScheduleLimitCheck is not set.');
        }
        unset($this->NeighborhoodsKojoDataJobCollectionScheduleLimitCheck);

        return $this;
    }
}
