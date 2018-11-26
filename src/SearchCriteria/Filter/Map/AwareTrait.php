<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Map;

use Neighborhoods\Kojo\SearchCriteria\Filter\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSearchCriteriaFilterMap;

    public function setSearchCriteriaFilterMap(MapInterface $searchCriteriaFilterMap): self
    {
        if ($this->hasSearchCriteriaFilterMap()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFilterMap is already set.');
        }
        $this->NeighborhoodsKojoSearchCriteriaFilterMap = $searchCriteriaFilterMap;

        return $this;
    }

    protected function getSearchCriteriaFilterMap(): MapInterface
    {
        if (!$this->hasSearchCriteriaFilterMap()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFilterMap is not set.');
        }

        return $this->NeighborhoodsKojoSearchCriteriaFilterMap;
    }

    protected function hasSearchCriteriaFilterMap(): bool
    {
        return isset($this->NeighborhoodsKojoSearchCriteriaFilterMap);
    }

    protected function unsetSearchCriteriaFilterMap(): self
    {
        if (!$this->hasSearchCriteriaFilterMap()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFilterMap is not set.');
        }
        unset($this->NeighborhoodsKojoSearchCriteriaFilterMap);

        return $this;
    }
}
