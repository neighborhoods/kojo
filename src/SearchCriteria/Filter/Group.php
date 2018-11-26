<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\Filter;

use Neighborhoods\Kojo\SearchCriteria\FilterInterface;
use Neighborhoods\Kojo\SearchCriteria\Filter;

class Group implements GroupInterface
{
    use Filter\Map\AwareTrait;

    public function addFilter(FilterInterface $filter): GroupInterface
    {
        $this->getSearchCriteriaFilterMap()[] = $filter;

        return $this;
    }

    public function getFilters(): Filter\MapInterface
    {
        return $this->getSearchCriteriaFilterMap();
    }
}
