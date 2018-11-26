<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\Builder;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $SearchCriteriaFilterGroupMapBuilder = null;

    public function setSearchCriteriaFilterGroupMapBuilder(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\BuilderInterface $SearchCriteriaFilterGroupMapBuilder) : self
    {
        if ($this->hasSearchCriteriaFilterGroupMapBuilder()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapBuilder is already set.');
        }
        $this->SearchCriteriaFilterGroupMapBuilder = $SearchCriteriaFilterGroupMapBuilder;

        return $this;
    }

    protected function getSearchCriteriaFilterGroupMapBuilder() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\BuilderInterface
    {
        if (!$this->hasSearchCriteriaFilterGroupMapBuilder()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapBuilder is not set.');
        }

        return $this->SearchCriteriaFilterGroupMapBuilder;
    }

    protected function hasSearchCriteriaFilterGroupMapBuilder() : bool
    {
        return isset($this->SearchCriteriaFilterGroupMapBuilder);
    }

    protected function unsetSearchCriteriaFilterGroupMapBuilder() : self
    {
        if (!$this->hasSearchCriteriaFilterGroupMapBuilder()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapBuilder is not set.');
        }
        unset($this->SearchCriteriaFilterGroupMapBuilder);

        return $this;
    }


}

