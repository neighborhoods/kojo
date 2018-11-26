<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Map\Factory;

use Neighborhoods\Kojo\SearchCriteria\Filter\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSearchCriteriaFilterMapFactory;

    public function setSearchCriteriaFilterMapFactory(FactoryInterface $searchCriteriaFilterMapFactory): self
    {
        if ($this->hasSearchCriteriaFilterMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFilterMapFactory is already set.');
        }
        $this->NeighborhoodsKojoSearchCriteriaFilterMapFactory = $searchCriteriaFilterMapFactory;

        return $this;
    }

    protected function getSearchCriteriaFilterMapFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaFilterMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFilterMapFactory is not set.');
        }

        return $this->NeighborhoodsKojoSearchCriteriaFilterMapFactory;
    }

    protected function hasSearchCriteriaFilterMapFactory(): bool
    {
        return isset($this->NeighborhoodsKojoSearchCriteriaFilterMapFactory);
    }

    protected function unsetSearchCriteriaFilterMapFactory(): self
    {
        if (!$this->hasSearchCriteriaFilterMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoSearchCriteriaFilterMapFactory is not set.');
        }
        unset($this->NeighborhoodsKojoSearchCriteriaFilterMapFactory);

        return $this;
    }
}
