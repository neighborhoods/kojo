<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\SearchCriteria\Filter;

use Neighborhoods\Kojo\SearchCriteria\FilterInterface;
use Neighborhoods\Kojo\SearchCriteria\Filter;

interface GroupInterface
{
    public function addFilter(FilterInterface $filter): GroupInterface;

    public function getFilters(): Filter\MapInterface;
}
