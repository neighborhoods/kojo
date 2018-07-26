<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection\Selector;

use Neighborhoods\Kojo\Job\Collection\SelectorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDataJobCollectionSelector;

    public function setDataJobCollectionSelector(SelectorInterface $dataJobCollectionSelector): self
    {
        if ($this->hasDataJobCollectionSelector()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionSelector is already set.');
        }
        $this->NeighborhoodsKojoDataJobCollectionSelector = $dataJobCollectionSelector;

        return $this;
    }

    protected function getDataJobCollectionSelector(): SelectorInterface
    {
        if (!$this->hasDataJobCollectionSelector()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionSelector is not set.');
        }

        return $this->NeighborhoodsKojoDataJobCollectionSelector;
    }

    protected function hasDataJobCollectionSelector(): bool
    {
        return isset($this->NeighborhoodsKojoDataJobCollectionSelector);
    }

    protected function unsetDataJobCollectionSelector(): self
    {
        if (!$this->hasDataJobCollectionSelector()) {
            throw new \LogicException('NeighborhoodsKojoDataJobCollectionSelector is not set.');
        }
        unset($this->NeighborhoodsKojoDataJobCollectionSelector);

        return $this;
    }
}
