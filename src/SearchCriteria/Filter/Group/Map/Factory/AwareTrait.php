<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $SearchCriteriaFilterGroupMapFactory = null;

    public function setSearchCriteriaFilterGroupMapFactory(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\FactoryInterface $SearchCriteriaFilterGroupMapFactory) : self
    {
        if ($this->hasSearchCriteriaFilterGroupMapFactory()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapFactory is already set.');
        }
        $this->SearchCriteriaFilterGroupMapFactory = $SearchCriteriaFilterGroupMapFactory;

        return $this;
    }

    protected function getSearchCriteriaFilterGroupMapFactory() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\FactoryInterface
    {
        if (!$this->hasSearchCriteriaFilterGroupMapFactory()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapFactory is not set.');
        }

        return $this->SearchCriteriaFilterGroupMapFactory;
    }

    protected function hasSearchCriteriaFilterGroupMapFactory() : bool
    {
        return isset($this->SearchCriteriaFilterGroupMapFactory);
    }

    protected function unsetSearchCriteriaFilterGroupMapFactory() : self
    {
        if (!$this->hasSearchCriteriaFilterGroupMapFactory()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapFactory is not set.');
        }
        unset($this->SearchCriteriaFilterGroupMapFactory);

        return $this;
    }


}

