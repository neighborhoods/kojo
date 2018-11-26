<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria;

use Neighborhoods\Kojo\SearchCriteriaInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSearchCriteria;

    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria): self
    {
        if ($this->hasSearchCriteria()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteria is already set.');
        }
        $this->NeighborhoodsKojoSearchCriteria = $searchCriteria;

        return $this;
    }

    protected function getSearchCriteria(): SearchCriteriaInterface
    {
        if (!$this->hasSearchCriteria()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteria is not set.');
        }

        return $this->NeighborhoodsKojoSearchCriteria;
    }

    protected function hasSearchCriteria(): bool
    {
        return isset($this->NeighborhoodsKojoSearchCriteria);
    }

    protected function unsetSearchCriteria(): self
    {
        if (!$this->hasSearchCriteria()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteria is not set.');
        }
        unset($this->NeighborhoodsKojoSearchCriteria);

        return $this;
    }
}
