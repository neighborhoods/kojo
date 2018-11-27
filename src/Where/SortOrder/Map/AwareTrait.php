<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\SortOrder\Map;

use Neighborhoods\Kojo\Where\SortOrder\MapInterface;

trait AwareTrait
{
    protected $NeighborhoodsKojoWhereSortOrderMap;

    public function setWhereSortOrderMap(MapInterface $whereSortOrderMap): self
    {
        if ($this->hasWhereSortOrderMap()) {
            throw new \LogicException('NeighborhoodsKojoWhereSortOrderMap is already set.');
        }
        $this->NeighborhoodsKojoWhereSortOrderMap = $whereSortOrderMap;

        return $this;
    }

    protected function getWhereSortOrderMap(): MapInterface
    {
        if (!$this->hasWhereSortOrderMap()) {
            throw new \LogicException('NeighborhoodsKojoWhereSortOrderMap is not set.');
        }

        return $this->NeighborhoodsKojoWhereSortOrderMap;
    }

    protected function hasWhereSortOrderMap(): bool
    {
        return isset($this->NeighborhoodsKojoWhereSortOrderMap);
    }

    protected function unsetWhereSortOrderMap(): self
    {
        if (!$this->hasWhereSortOrderMap()) {
            throw new \LogicException('NeighborhoodsKojoWhereSortOrderMap is not set.');
        }
        unset($this->NeighborhoodsKojoWhereSortOrderMap);

        return $this;
    }
}
