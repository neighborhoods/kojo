<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\SearchCriteria\SortOrder;
use Neighborhoods\Kojo\SearchCriteria\Filter;
use Neighborhoods\Kojo\SearchCriteria\SortOrderInterface;

class SearchCriteria implements SearchCriteriaInterface
{
    use Filter\Group\Map\AwareTrait;
    use SortOrder\Map\AwareTrait;
    /** @var int */
    protected $pageSize;
    /** @var int */
    protected $currentPage;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function addFilterGroup(Filter\GroupInterface $filter): SearchCriteriaInterface
    {
        $this->getSearchCriteriaFilterGroupMap()[] = $filter;

        return $this;
    }

    public function getFilterGroups(): Filter\Group\MapInterface
    {
        return $this->getSearchCriteriaFilterGroupMap();
    }

    public function getSortOrders(): SortOrder\MapInterface
    {
        return $this->getSearchCriteriaSortOrderMap();
    }

    public function addSortOrder(SortOrderInterface $sortOrder): SearchCriteriaInterface
    {
        $this->getSearchCriteriaSortOrderMap()[] = $sortOrder;

        return $this;
    }

    public function getPageSize(): int
    {
        if ($this->pageSize === null) {
            throw new \LogicException('SearchCriteria pageSize has not been set.');
        }

        return $this->pageSize;
    }

    public function setPageSize(int $pageSize): SearchCriteriaInterface
    {
        if ($this->pageSize !== null) {
            throw new \LogicException('SearchCriteria pageSize is already set.');
        }
        $this->pageSize = $pageSize;

        return $this;
    }

    public function getCurrentPage(): int
    {
        if ($this->currentPage === null) {
            throw new \LogicException('SearchCriteria currentPage has not been set.');
        }

        return $this->currentPage;
    }

    public function setCurrentPage(int $currentPage): SearchCriteriaInterface
    {
        if ($this->currentPage !== null) {
            throw new \LogicException('SearchCriteria currentPage is already set.');
        }
        $this->currentPage = $currentPage;

        return $this;
    }
}
