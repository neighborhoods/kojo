<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $SearchCriteriaFilterGroup = null;

    public function setSearchCriteriaFilterGroup(\Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface $SearchCriteriaFilterGroup) : self
    {
        if ($this->hasSearchCriteriaFilterGroup()) {
            throw new \LogicException('SearchCriteriaFilterGroup is already set.');
        }
        $this->SearchCriteriaFilterGroup = $SearchCriteriaFilterGroup;

        return $this;
    }

    protected function getSearchCriteriaFilterGroup() : \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface
    {
        if (!$this->hasSearchCriteriaFilterGroup()) {
            throw new \LogicException('SearchCriteriaFilterGroup is not set.');
        }

        return $this->SearchCriteriaFilterGroup;
    }

    protected function hasSearchCriteriaFilterGroup() : bool
    {
        return isset($this->SearchCriteriaFilterGroup);
    }

    protected function unsetSearchCriteriaFilterGroup() : self
    {
        if (!$this->hasSearchCriteriaFilterGroup()) {
            throw new \LogicException('SearchCriteriaFilterGroup is not set.');
        }
        unset($this->SearchCriteriaFilterGroup);

        return $this;
    }


}

