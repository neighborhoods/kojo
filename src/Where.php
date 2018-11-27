<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Where\Filter\GroupInterface;
use Neighborhoods\Kojo\Where\SortOrder;
use Neighborhoods\Kojo\Where\Filter;
use Neighborhoods\Kojo\Where\SortOrderInterface;

class Where implements WhereInterface
{
    use Filter\Group\Map\Factory\AwareTrait;
    use SortOrder\Map\Factory\AwareTrait;
    protected $page_size;
    protected $current_page;
    protected $filter_groups;
    protected $sort_orders;

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

    public function getSortOrders(): SortOrder\MapInterface
    {
        return $this->getWhereSortOrderMap();
    }

    public function addSortOrder(SortOrderInterface $sortOrder): WhereInterface
    {
        $this->getWhereSortOrderMap()[] = $sortOrder;

        return $this;
    }

    public function getPageSize(): int
    {
        if ($this->page_size === null) {
            throw new \LogicException('Where pageSize has not been set.');
        }

        return $this->page_size;
    }

    public function setPageSize(int $pageSize): WhereInterface
    {
        if ($this->page_size !== null) {
            throw new \LogicException('Where pageSize is already set.');
        }
        $this->page_size = $pageSize;

        return $this;
    }

    public function getCurrentPage(): int
    {
        if ($this->current_page === null) {
            throw new \LogicException('Where currentPage has not been set.');
        }

        return $this->current_page;
    }

    public function setCurrentPage(int $currentPage): WhereInterface
    {
        if ($this->current_page !== null) {
            throw new \LogicException('Where currentPage is already set.');
        }
        $this->current_page = $currentPage;

        return $this;
    }

    protected function getWhereFilterGroupMap(): Filter\Group\MapInterface
    {
        if ($this->filter_groups === null) {
            $this->filter_groups = $this->getWhereFilterGroupMapFactory()->create();
        }

        return $this->filter_groups;
    }

    protected function getWhereSortOrderMap(): SortOrder\MapInterface
    {
        if ($this->sort_orders === null) {
            $this->sort_orders = $this->getWhereSortOrderMapFactory()->create();
        }

        return $this->sort_orders;
    }
}
