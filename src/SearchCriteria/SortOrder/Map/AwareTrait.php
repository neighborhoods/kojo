<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\SortOrder\Map;

use Neighborhoods\Kojo\SearchCriteria\SortOrder\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSearchCriteriaSortOrderMap;

    public function setSearchCriteriaSortOrderMap(MapInterface $searchCriteriaSortOrderMap): self
    {
        if ($this->hasSearchCriteriaSortOrderMap()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaSortOrderMap is already set.');
        }
        $this->NeighborhoodsKojoSearchCriteriaSortOrderMap = $searchCriteriaSortOrderMap;

        return $this;
    }

    protected function getSearchCriteriaSortOrderMap(): MapInterface
    {
        if (!$this->hasSearchCriteriaSortOrderMap()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaSortOrderMap is not set.');
        }

        return $this->NeighborhoodsKojoSearchCriteriaSortOrderMap;
    }

    protected function hasSearchCriteriaSortOrderMap(): bool
    {
        return isset($this->NeighborhoodsKojoSearchCriteriaSortOrderMap);
    }

    protected function unsetSearchCriteriaSortOrderMap(): self
    {
        if (!$this->hasSearchCriteriaSortOrderMap()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaSortOrderMap is not set.');
        }
        unset($this->NeighborhoodsKojoSearchCriteriaSortOrderMap);

        return $this;
    }
}
