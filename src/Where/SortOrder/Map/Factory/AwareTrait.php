<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\SortOrder\Map\Factory;

use Neighborhoods\Kojo\Where\SortOrder\Map\FactoryInterface;

trait AwareTrait
{
    protected $NeighborhoodsKojoWhereSortOrderMapFactory;

    public function setWhereSortOrderMapFactory(FactoryInterface $whereSortOrderMapFactory): self
    {
        if ($this->hasWhereSortOrderMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereSortOrderMapFactory is already set.');
        }
        $this->NeighborhoodsKojoWhereSortOrderMapFactory = $whereSortOrderMapFactory;

        return $this;
    }

    protected function getWhereSortOrderMapFactory(): FactoryInterface
    {
        if (!$this->hasWhereSortOrderMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereSortOrderMapFactory is not set.');
        }

        return $this->NeighborhoodsKojoWhereSortOrderMapFactory;
    }

    protected function hasWhereSortOrderMapFactory(): bool
    {
        return isset($this->NeighborhoodsKojoWhereSortOrderMapFactory);
    }

    protected function unsetWhereSortOrderMapFactory(): self
    {
        if (!$this->hasWhereSortOrderMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereSortOrderMapFactory is not set.');
        }
        unset($this->NeighborhoodsKojoWhereSortOrderMapFactory);

        return $this;
    }
}
