<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\SortOrder\Map\Factory;

use Neighborhoods\Kojo\SearchCriteria\SortOrder\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSearchCriteriaSortOrderMapFactory;

    public function setSearchCriteriaSortOrderMapFactory(FactoryInterface $searchCriteriaSortOrderMapFactory): self
    {
        if ($this->hasSearchCriteriaSortOrderMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaSortOrderMapFactory is already set.');
        }
        $this->NeighborhoodsKojoSearchCriteriaSortOrderMapFactory = $searchCriteriaSortOrderMapFactory;

        return $this;
    }

    protected function getSearchCriteriaSortOrderMapFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaSortOrderMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaSortOrderMapFactory is not set.');
        }

        return $this->NeighborhoodsKojoSearchCriteriaSortOrderMapFactory;
    }

    protected function hasSearchCriteriaSortOrderMapFactory(): bool
    {
        return isset($this->NeighborhoodsKojoSearchCriteriaSortOrderMapFactory);
    }

    protected function unsetSearchCriteriaSortOrderMapFactory(): self
    {
        if (!$this->hasSearchCriteriaSortOrderMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaSortOrderMapFactory is not set.');
        }
        unset($this->NeighborhoodsKojoSearchCriteriaSortOrderMapFactory);

        return $this;
    }
}
