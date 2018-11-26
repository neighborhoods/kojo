<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\SortOrder\Factory;

use Neighborhoods\Kojo\SearchCriteria\SortOrder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSearchCriteriaSortOrderFactory;

    public function setSearchCriteriaSortOrderFactory(FactoryInterface $searchCriteriaSortOrderFactory): self
    {
        if ($this->hasSearchCriteriaSortOrderFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaSortOrderFactory is already set.');
        }
        $this->NeighborhoodsKojoSearchCriteriaSortOrderFactory = $searchCriteriaSortOrderFactory;

        return $this;
    }

    protected function getSearchCriteriaSortOrderFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaSortOrderFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaSortOrderFactory is not set.');
        }

        return $this->NeighborhoodsKojoSearchCriteriaSortOrderFactory;
    }

    protected function hasSearchCriteriaSortOrderFactory(): bool
    {
        return isset($this->NeighborhoodsKojoSearchCriteriaSortOrderFactory);
    }

    protected function unsetSearchCriteriaSortOrderFactory(): self
    {
        if (!$this->hasSearchCriteriaSortOrderFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaSortOrderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoSearchCriteriaSortOrderFactory);

        return $this;
    }
}
