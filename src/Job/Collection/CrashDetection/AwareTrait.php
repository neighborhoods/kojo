<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection\CrashDetection;

use Neighborhoods\Kojo\Job\Collection\CrashDetectionInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDataJobCollectionCrashDetection;

    public function setDataJobCollectionCrashDetection(CrashDetectionInterface $dataJobCollectionCrashDetection): self
    {
        if ($this->hasDataJobCollectionCrashDetection()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionCrashDetection is already set.');
        }
        $this->NeighborhoodsKojoDataJobCollectionCrashDetection = $dataJobCollectionCrashDetection;

        return $this;
    }

    protected function getDataJobCollectionCrashDetection(): CrashDetectionInterface
    {
        if (!$this->hasDataJobCollectionCrashDetection()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionCrashDetection is not set.');
        }

        return $this->NeighborhoodsKojoDataJobCollectionCrashDetection;
    }

    protected function hasDataJobCollectionCrashDetection(): bool
    {
        return isset($this->NeighborhoodsKojoDataJobCollectionCrashDetection);
    }

    protected function unsetDataJobCollectionCrashDetection(): self
    {
        if (!$this->hasDataJobCollectionCrashDetection()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionCrashDetection is not set.');
        }
        unset($this->NeighborhoodsKojoDataJobCollectionCrashDetection);

        return $this;
    }
}
