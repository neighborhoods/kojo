<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Factory;

use Neighborhoods\Kojo\SearchCriteria\Filter\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSearchCriteriaFilterFactory;

    public function setSearchCriteriaFilterFactory(FactoryInterface $searchCriteriaFilterFactory): self
    {
        if ($this->hasSearchCriteriaFilterFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFilterFactory is already set.');
        }
        $this->NeighborhoodsKojoSearchCriteriaFilterFactory = $searchCriteriaFilterFactory;

        return $this;
    }

    protected function getSearchCriteriaFilterFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaFilterFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFilterFactory is not set.');
        }

        return $this->NeighborhoodsKojoSearchCriteriaFilterFactory;
    }

    protected function hasSearchCriteriaFilterFactory(): bool
    {
        return isset($this->NeighborhoodsKojoSearchCriteriaFilterFactory);
    }

    protected function unsetSearchCriteriaFilterFactory(): self
    {
        if (!$this->hasSearchCriteriaFilterFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFilterFactory is not set.');
        }
        unset($this->NeighborhoodsKojoSearchCriteriaFilterFactory);

        return $this;
    }
}
