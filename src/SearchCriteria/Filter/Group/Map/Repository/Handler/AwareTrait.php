<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\Repository\Handler;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $SearchCriteriaFilterGroupMapRepositoryHandler = null;

    public function setSearchCriteriaFilterGroupMapRepositoryHandler(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\Repository\HandlerInterface $SearchCriteriaFilterGroupMapRepositoryHandler) : self
    {
        if ($this->hasSearchCriteriaFilterGroupMapRepositoryHandler()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapRepositoryHandler is already set.');
        }
        $this->SearchCriteriaFilterGroupMapRepositoryHandler = $SearchCriteriaFilterGroupMapRepositoryHandler;

        return $this;
    }

    protected function getSearchCriteriaFilterGroupMapRepositoryHandler() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\Repository\HandlerInterface
    {
        if (!$this->hasSearchCriteriaFilterGroupMapRepositoryHandler()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapRepositoryHandler is not set.');
        }

        return $this->SearchCriteriaFilterGroupMapRepositoryHandler;
    }

    protected function hasSearchCriteriaFilterGroupMapRepositoryHandler() : bool
    {
        return isset($this->SearchCriteriaFilterGroupMapRepositoryHandler);
    }

    protected function unsetSearchCriteriaFilterGroupMapRepositoryHandler() : self
    {
        if (!$this->hasSearchCriteriaFilterGroupMapRepositoryHandler()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapRepositoryHandler is not set.');
        }
        unset($this->SearchCriteriaFilterGroupMapRepositoryHandler);

        return $this;
    }


}

