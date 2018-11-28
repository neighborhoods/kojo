<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Where\Filter;
use Neighborhoods\Kojo\Where\SortOrder;
use Neighborhoods\Kojo\Where\SortOrderInterface;

interface WhereInterface extends \JsonSerializable
{
    public function setWhereFilterGroupMap(Where\Filter\Group\MapInterface $WhereFilterGroupMap);

    public function addFilterGroup(Filter\GroupInterface $filter): WhereInterface;

    public function getFilterGroups(): Filter\Group\MapInterface;

    public function setWhereSortOrderMap(Where\SortOrder\MapInterface $whereSortOrderMap);

    public function getSortOrders(): SortOrder\MapInterface;

    public function addSortOrder(SortOrderInterface $sortOrder): WhereInterface;

    public function getPageSize(): int;

    public function setPageSize(int $pageSize): WhereInterface;

    public function getCurrentPage(): int;

    public function setCurrentPage(int $currentPage): WhereInterface;
}
