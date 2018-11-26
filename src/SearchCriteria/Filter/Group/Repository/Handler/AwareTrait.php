<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Repository\Handler;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $SearchCriteriaFilterGroupRepositoryHandler = null;

    public function setSearchCriteriaFilterGroupRepositoryHandler(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\Repository\HandlerInterface $SearchCriteriaFilterGroupRepositoryHandler) : self
    {
        if ($this->hasSearchCriteriaFilterGroupRepositoryHandler()) {
            throw new \LogicException('SearchCriteriaFilterGroupRepositoryHandler is already set.');
        }
        $this->SearchCriteriaFilterGroupRepositoryHandler = $SearchCriteriaFilterGroupRepositoryHandler;

        return $this;
    }

    protected function getSearchCriteriaFilterGroupRepositoryHandler() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Repository\HandlerInterface
    {
        if (!$this->hasSearchCriteriaFilterGroupRepositoryHandler()) {
            throw new \LogicException('SearchCriteriaFilterGroupRepositoryHandler is not set.');
        }

        return $this->SearchCriteriaFilterGroupRepositoryHandler;
    }

    protected function hasSearchCriteriaFilterGroupRepositoryHandler() : bool
    {
        return isset($this->SearchCriteriaFilterGroupRepositoryHandler);
    }

    protected function unsetSearchCriteriaFilterGroupRepositoryHandler() : self
    {
        if (!$this->hasSearchCriteriaFilterGroupRepositoryHandler()) {
            throw new \LogicException('SearchCriteriaFilterGroupRepositoryHandler is not set.');
        }
        unset($this->SearchCriteriaFilterGroupRepositoryHandler);

        return $this;
    }


}

