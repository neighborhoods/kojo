<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Where\Filter\GroupInterface;
use Neighborhoods\Kojo\Where\SortOrder;
use Neighborhoods\Kojo\Where\Filter;
use Neighborhoods\Kojo\Where\SortOrderInterface;

class Where implements WhereInterface
{
    use Filter\Group\Map\AwareTrait;
    use SortOrder\Map\AwareTrait;
    protected $page_size;
    protected $current_page;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function addFilterGroup(GroupInterface $filter): WhereInterface
    {
        $this->getWhereFilterGroupMap()[] = $filter;

        return $this;
    }

    public function getFilterGroups(): Filter\Group\MapInterface
    {
        return $this->getWhereFilterGroupMap();
    }

    public function setFilterGroups(): Filter\Group\MapInterface
    {
        return $this->getWhereFilterGroupMap();
    }

    public function getSortOrders(): SortOrder\MapInterface
    {
        return $this->getWhereSortOrderMap();
    }

    public function addSortOrder(SortOrderInterface $sort_order): WhereInterface
    {
        $this->getWhereSortOrderMap()[] = $sort_order;

        return $this;
    }

    public function getPageSize(): int
    {
        if ($this->page_size === null) {
            throw new \LogicException('Where page_size has not been set.');
        }

        return $this->page_size;
    }

    public function setPageSize(int $page_size): WhereInterface
    {
        if ($this->page_size !== null) {
            throw new \LogicException('Where page_size is already set.');
        }
        $this->page_size = $page_size;

        return $this;
    }

    public function getCurrentPage(): int
    {
        if ($this->current_page === null) {
            throw new \LogicException('Where current_page has not been set.');
        }

        return $this->current_page;
    }

    public function setCurrentPage(int $current_page): WhereInterface
    {
        if ($this->current_page !== null) {
            throw new \LogicException('Where current_page is already set.');
        }
        $this->current_page = $current_page;

        return $this;
    }
}
