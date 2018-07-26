<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection\Delete;

use Neighborhoods\Kojo\Job\Collection\DeleteInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDataJobCollectionDelete;

    public function setDataJobCollectionDelete(DeleteInterface $dataJobCollectionDelete): self
    {
        if ($this->hasDataJobCollectionDelete()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionDelete is already set.');
        }
        $this->NeighborhoodsKojoDataJobCollectionDelete = $dataJobCollectionDelete;

        return $this;
    }

    protected function getDataJobCollectionDelete(): DeleteInterface
    {
        if (!$this->hasDataJobCollectionDelete()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionDelete is not set.');
        }

        return $this->NeighborhoodsKojoDataJobCollectionDelete;
    }

    protected function hasDataJobCollectionDelete(): bool
    {
        return isset($this->NeighborhoodsKojoDataJobCollectionDelete);
    }

    protected function unsetDataJobCollectionDelete(): self
    {
        if (!$this->hasDataJobCollectionDelete()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionDelete is not set.');
        }
        unset($this->NeighborhoodsKojoDataJobCollectionDelete);

        return $this;
    }
}
