<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\SortOrder\Factory;

use Neighborhoods\Kojo\Where\SortOrder\FactoryInterface;

trait AwareTrait
{
    protected $NeighborhoodsKojoWhereSortOrderFactory;

    public function setWhereSortOrderFactory(FactoryInterface $whereSortOrderFactory): self
    {
        if ($this->hasWhereSortOrderFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereSortOrderFactory is already set.');
        }
        $this->NeighborhoodsKojoWhereSortOrderFactory = $whereSortOrderFactory;

        return $this;
    }

    protected function getWhereSortOrderFactory(): FactoryInterface
    {
        if (!$this->hasWhereSortOrderFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereSortOrderFactory is not set.');
        }

        return $this->NeighborhoodsKojoWhereSortOrderFactory;
    }

    protected function hasWhereSortOrderFactory(): bool
    {
        return isset($this->NeighborhoodsKojoWhereSortOrderFactory);
    }

    protected function unsetWhereSortOrderFactory(): self
    {
        if (!$this->hasWhereSortOrderFactory()) {
            throw new \LogicException('NeighborhoodsKojoWhereSortOrderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoWhereSortOrderFactory);

        return $this;
    }
}
