<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\Repository;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $SearchCriteriaFilterGroupMapRepository = null;

    public function setSearchCriteriaFilterGroupMapRepository(\Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\RepositoryInterface $SearchCriteriaFilterGroupMapRepository) : self
    {
        if ($this->hasSearchCriteriaFilterGroupMapRepository()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapRepository is already set.');
        }
        $this->SearchCriteriaFilterGroupMapRepository = $SearchCriteriaFilterGroupMapRepository;

        return $this;
    }

    protected function getSearchCriteriaFilterGroupMapRepository() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\RepositoryInterface
    {
        if (!$this->hasSearchCriteriaFilterGroupMapRepository()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapRepository is not set.');
        }

        return $this->SearchCriteriaFilterGroupMapRepository;
    }

    protected function hasSearchCriteriaFilterGroupMapRepository() : bool
    {
        return isset($this->SearchCriteriaFilterGroupMapRepository);
    }

    protected function unsetSearchCriteriaFilterGroupMapRepository() : self
    {
        if (!$this->hasSearchCriteriaFilterGroupMapRepository()) {
            throw new \LogicException('SearchCriteriaFilterGroupMapRepository is not set.');
        }
        unset($this->SearchCriteriaFilterGroupMapRepository);

        return $this;
    }


}

