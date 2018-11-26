<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\Filter;

use Neighborhoods\Kojo\SearchCriteria\FilterInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSearchCriteriaFilter;

    public function setSearchCriteriaFilter(FilterInterface $searchCriteriaFilter): self
    {
        if ($this->hasSearchCriteriaFilter()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFilter is already set.');
        }
        $this->NeighborhoodsKojoSearchCriteriaFilter = $searchCriteriaFilter;

        return $this;
    }

    protected function getSearchCriteriaFilter(): FilterInterface
    {
        if (!$this->hasSearchCriteriaFilter()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFilter is not set.');
        }

        return $this->NeighborhoodsKojoSearchCriteriaFilter;
    }

    protected function hasSearchCriteriaFilter(): bool
    {
        return isset($this->NeighborhoodsKojoSearchCriteriaFilter);
    }

    protected function unsetSearchCriteriaFilter(): self
    {
        if (!$this->hasSearchCriteriaFilter()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFilter is not set.');
        }
        unset($this->NeighborhoodsKojoSearchCriteriaFilter);

        return $this;
    }
}
