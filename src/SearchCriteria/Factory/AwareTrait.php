<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\Factory;

use Neighborhoods\Kojo\SearchCriteria\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSearchCriteriaFactory;

    public function setSearchCriteriaFactory(FactoryInterface $searchCriteriaFactory): self
    {
        if ($this->hasSearchCriteriaFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFactory is already set.');
        }
        $this->NeighborhoodsKojoSearchCriteriaFactory = $searchCriteriaFactory;

        return $this;
    }

    protected function getSearchCriteriaFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFactory is not set.');
        }

        return $this->NeighborhoodsKojoSearchCriteriaFactory;
    }

    protected function hasSearchCriteriaFactory(): bool
    {
        return isset($this->NeighborhoodsKojoSearchCriteriaFactory);
    }

    protected function unsetSearchCriteriaFactory(): self
    {
        if (!$this->hasSearchCriteriaFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFactory is not set.');
        }
        unset($this->NeighborhoodsKojoSearchCriteriaFactory);

        return $this;
    }
}
