<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\SortOrder;

use Neighborhoods\Kojo\SearchCriteria\SortOrderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSearchCriteriaSortOrder;

    public function setSearchCriteriaSortOrder(SortOrderInterface $searchCriteriaSortOrder): self
    {
        if ($this->hasSearchCriteriaSortOrder()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaSortOrder is already set.');
        }
        $this->NeighborhoodsKojoSearchCriteriaSortOrder = $searchCriteriaSortOrder;

        return $this;
    }

    protected function getSearchCriteriaSortOrder(): SortOrderInterface
    {
        if (!$this->hasSearchCriteriaSortOrder()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaSortOrder is not set.');
        }

        return $this->NeighborhoodsKojoSearchCriteriaSortOrder;
    }

    protected function hasSearchCriteriaSortOrder(): bool
    {
        return isset($this->NeighborhoodsKojoSearchCriteriaSortOrder);
    }

    protected function unsetSearchCriteriaSortOrder(): self
    {
        if (!$this->hasSearchCriteriaSortOrder()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaSortOrder is not set.');
        }
        unset($this->NeighborhoodsKojoSearchCriteriaSortOrder);

        return $this;
    }
}
