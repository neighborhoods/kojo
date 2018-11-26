<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Builder\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $SearchCriteriaFilterGroupBuilderFactory = null;

    public function setSearchCriteriaFilterGroupBuilderFactory(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\Builder\FactoryInterface $SearchCriteriaFilterGroupBuilderFactory) : self
    {
        if ($this->hasSearchCriteriaFilterGroupBuilderFactory()) {
            throw new \LogicException('SearchCriteriaFilterGroupBuilderFactory is already set.');
        }
        $this->SearchCriteriaFilterGroupBuilderFactory = $SearchCriteriaFilterGroupBuilderFactory;

        return $this;
    }

    protected function getSearchCriteriaFilterGroupBuilderFactory() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Builder\FactoryInterface
    {
        if (!$this->hasSearchCriteriaFilterGroupBuilderFactory()) {
            throw new \LogicException('SearchCriteriaFilterGroupBuilderFactory is not set.');
        }

        return $this->SearchCriteriaFilterGroupBuilderFactory;
    }

    protected function hasSearchCriteriaFilterGroupBuilderFactory() : bool
    {
        return isset($this->SearchCriteriaFilterGroupBuilderFactory);
    }

    protected function unsetSearchCriteriaFilterGroupBuilderFactory() : self
    {
        if (!$this->hasSearchCriteriaFilterGroupBuilderFactory()) {
            throw new \LogicException('SearchCriteriaFilterGroupBuilderFactory is not set.');
        }
        unset($this->SearchCriteriaFilterGroupBuilderFactory);

        return $this;
    }


}

