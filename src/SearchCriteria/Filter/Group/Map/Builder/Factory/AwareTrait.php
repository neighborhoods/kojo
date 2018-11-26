<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\Builder\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $SearchCriteriaFilterGroupMapBuilderFactory = null;

    public function setSearchCriteriaFilterGroupMapBuilderFactory(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\Builder\FactoryInterface $SearchCriteriaFilterGroupMapBuilderFactory) : self
    {
        if ($this->hasSearchCriteriaFilterGroupMapBuilderFactory()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapBuilderFactory is already set.');
        }
        $this->SearchCriteriaFilterGroupMapBuilderFactory = $SearchCriteriaFilterGroupMapBuilderFactory;

        return $this;
    }

    protected function getSearchCriteriaFilterGroupMapBuilderFactory() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\Builder\FactoryInterface
    {
        if (!$this->hasSearchCriteriaFilterGroupMapBuilderFactory()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapBuilderFactory is not set.');
        }

        return $this->SearchCriteriaFilterGroupMapBuilderFactory;
    }

    protected function hasSearchCriteriaFilterGroupMapBuilderFactory() : bool
    {
        return isset($this->SearchCriteriaFilterGroupMapBuilderFactory);
    }

    protected function unsetSearchCriteriaFilterGroupMapBuilderFactory() : self
    {
        if (!$this->hasSearchCriteriaFilterGroupMapBuilderFactory()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapBuilderFactory is not set.');
        }
        unset($this->SearchCriteriaFilterGroupMapBuilderFactory);

        return $this;
    }


}

