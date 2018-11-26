<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Factory;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $SearchCriteriaFilterGroupFactory = null;

    public function setSearchCriteriaFilterGroupFactory(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\FactoryInterface $SearchCriteriaFilterGroupFactory) : self
    {
        if ($this->hasSearchCriteriaFilterGroupFactory()) {
            throw new \LogicException('SearchCriteriaFilterGroupFactory is already set.');
        }
        $this->SearchCriteriaFilterGroupFactory = $SearchCriteriaFilterGroupFactory;

        return $this;
    }

    protected function getSearchCriteriaFilterGroupFactory() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\FactoryInterface
    {
        if (!$this->hasSearchCriteriaFilterGroupFactory()) {
            throw new \LogicException('SearchCriteriaFilterGroupFactory is not set.');
        }

        return $this->SearchCriteriaFilterGroupFactory;
    }

    protected function hasSearchCriteriaFilterGroupFactory() : bool
    {
        return isset($this->SearchCriteriaFilterGroupFactory);
    }

    protected function unsetSearchCriteriaFilterGroupFactory() : self
    {
        if (!$this->hasSearchCriteriaFilterGroupFactory()) {
            throw new \LogicException('SearchCriteriaFilterGroupFactory is not set.');
        }
        unset($this->SearchCriteriaFilterGroupFactory);

        return $this;
    }


}

