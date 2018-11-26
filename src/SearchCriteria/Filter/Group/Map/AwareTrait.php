<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $SearchCriteriaFilterGroupMap = null;

    public function setSearchCriteriaFilterGroupMap(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\MapInterface $SearchCriteriaFilterGroupMap) : self
    {
        if ($this->hasSearchCriteriaFilterGroupMap()) {
            throw new \LogicException('SearchCriteriaFilterGroupMap is already set.');
        }
        $this->SearchCriteriaFilterGroupMap = $SearchCriteriaFilterGroupMap;

        return $this;
    }

    protected function getSearchCriteriaFilterGroupMap() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\MapInterface
    {
        if (!$this->hasSearchCriteriaFilterGroupMap()) {
            throw new \LogicException('SearchCriteriaFilterGroupMap is not set.');
        }

        return $this->SearchCriteriaFilterGroupMap;
    }

    protected function hasSearchCriteriaFilterGroupMap() : bool
    {
        return isset($this->SearchCriteriaFilterGroupMap);
    }

    protected function unsetSearchCriteriaFilterGroupMap() : self
    {
        if (!$this->hasSearchCriteriaFilterGroupMap()) {
            throw new \LogicException('SearchCriteriaFilterGroupMap is not set.');
        }
        unset($this->SearchCriteriaFilterGroupMap);

        return $this;
    }


}

