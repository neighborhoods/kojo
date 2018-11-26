<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Builder;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $SearchCriteriaFilterGroupBuilder = null;

    public function setSearchCriteriaFilterGroupBuilder(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\BuilderInterface $SearchCriteriaFilterGroupBuilder) : self
    {
        if ($this->hasSearchCriteriaFilterGroupBuilder()) {
            throw new \LogicException('SearchCriteriaFilterGroupBuilder is already set.');
        }
        $this->SearchCriteriaFilterGroupBuilder = $SearchCriteriaFilterGroupBuilder;

        return $this;
    }

    protected function getSearchCriteriaFilterGroupBuilder() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\BuilderInterface
    {
        if (!$this->hasSearchCriteriaFilterGroupBuilder()) {
            throw new \LogicException('SearchCriteriaFilterGroupBuilder is not set.');
        }

        return $this->SearchCriteriaFilterGroupBuilder;
    }

    protected function hasSearchCriteriaFilterGroupBuilder() : bool
    {
        return isset($this->SearchCriteriaFilterGroupBuilder);
    }

    protected function unsetSearchCriteriaFilterGroupBuilder() : self
    {
        if (!$this->hasSearchCriteriaFilterGroupBuilder()) {
            throw new \LogicException('SearchCriteriaFilterGroupBuilder is not set.');
        }
        unset($this->SearchCriteriaFilterGroupBuilder);

        return $this;
    }


}

