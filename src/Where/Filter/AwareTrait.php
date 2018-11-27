<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter;

use Neighborhoods\Kojo\Where\FilterInterface;

trait AwareTrait
{
    protected $NeighborhoodsKojoWhereFilter;

    public function setWhereFilter(FilterInterface $whereFilter): self
    {
        if ($this->hasWhereFilter()) {
            throw new \LogicException('NeighborhoodsKojoWhereFilter is already set.');
        }
        $this->NeighborhoodsKojoWhereFilter = $whereFilter;

        return $this;
    }

    protected function getWhereFilter(): FilterInterface
    {
        if (!$this->hasWhereFilter()) {
            throw new \LogicException('NeighborhoodsKojoWhereFilter is not set.');
        }

        return $this->NeighborhoodsKojoWhereFilter;
    }

    protected function hasWhereFilter(): bool
    {
        return isset($this->NeighborhoodsKojoWhereFilter);
    }

    protected function unsetWhereFilter(): self
    {
        if (!$this->hasWhereFilter()) {
            throw new \LogicException('NeighborhoodsKojoWhereFilter is not set.');
        }
        unset($this->NeighborhoodsKojoWhereFilter);

        return $this;
    }
}
