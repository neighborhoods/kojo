<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Repository;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $SearchCriteriaFilterGroupRepository = null;

    public function setSearchCriteriaFilterGroupRepository(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\RepositoryInterface $SearchCriteriaFilterGroupRepository) : self
    {
        if ($this->hasSearchCriteriaFilterGroupRepository()) {
            throw new \LogicException('SearchCriteriaFilterGroupRepository is already set.');
        }
        $this->SearchCriteriaFilterGroupRepository = $SearchCriteriaFilterGroupRepository;

        return $this;
    }

    protected function getSearchCriteriaFilterGroupRepository() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\RepositoryInterface
    {
        if (!$this->hasSearchCriteriaFilterGroupRepository()) {
            throw new \LogicException('SearchCriteriaFilterGroupRepository is not set.');
        }

        return $this->SearchCriteriaFilterGroupRepository;
    }

    protected function hasSearchCriteriaFilterGroupRepository() : bool
    {
        return isset($this->SearchCriteriaFilterGroupRepository);
    }

    protected function unsetSearchCriteriaFilterGroupRepository() : self
    {
        if (!$this->hasSearchCriteriaFilterGroupRepository()) {
            throw new \LogicException('SearchCriteriaFilterGroupRepository is not set.');
        }
        unset($this->SearchCriteriaFilterGroupRepository);

        return $this;
    }


}

