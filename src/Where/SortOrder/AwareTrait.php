<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\SortOrder;

use Neighborhoods\Kojo\Where\SortOrderInterface;

trait AwareTrait
{
    protected $NeighborhoodsKojoWhereSortOrder;

    public function setWhereSortOrder(SortOrderInterface $whereSortOrder): self
    {
        if ($this->hasWhereSortOrder()) {
            throw new \LogicException('NeighborhoodsKojoWhereSortOrder is already set.');
        }
        $this->NeighborhoodsKojoWhereSortOrder = $whereSortOrder;

        return $this;
    }

    protected function getWhereSortOrder(): SortOrderInterface
    {
        if (!$this->hasWhereSortOrder()) {
            throw new \LogicException('NeighborhoodsKojoWhereSortOrder is not set.');
        }

        return $this->NeighborhoodsKojoWhereSortOrder;
    }

    protected function hasWhereSortOrder(): bool
    {
        return isset($this->NeighborhoodsKojoWhereSortOrder);
    }

    protected function unsetWhereSortOrder(): self
    {
        if (!$this->hasWhereSortOrder()) {
            throw new \LogicException('NeighborhoodsKojoWhereSortOrder is not set.');
        }
        unset($this->NeighborhoodsKojoWhereSortOrder);

        return $this;
    }
}
