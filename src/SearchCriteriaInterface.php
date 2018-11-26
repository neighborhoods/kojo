<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\SearchCriteria\Filter;
use Neighborhoods\Kojo\SearchCriteria\SortOrder;
use Neighborhoods\Kojo\SearchCriteria\SortOrderInterface;

interface SearchCriteriaInterface extends \JsonSerializable
{
    public function addFilterGroup(Filter\GroupInterface $filter): SearchCriteriaInterface;

    public function getFilterGroups(): Filter\Group\MapInterface;

    public function getSortOrders(): SortOrder\MapInterface;

    public function addSortOrder(SortOrderInterface $sortOrder): SearchCriteriaInterface;

    public function getPageSize(): int;

    public function setPageSize(int $pageSize): SearchCriteriaInterface;

    public function getCurrentPage(): int;

    public function setCurrentPage(int $currentPage): SearchCriteriaInterface;
}
