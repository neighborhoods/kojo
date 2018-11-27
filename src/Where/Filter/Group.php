<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter;

use Neighborhoods\Kojo\Where\FilterInterface;
use Neighborhoods\Kojo\Where\Filter;

class Group implements GroupInterface
{
    use Filter\Map\Factory\AwareTrait;

    protected $filters;

    public function addFilter(FilterInterface $filter): GroupInterface
    {
        $this->getWhereFilterMap()[] = $filter;

        return $this;
    }

    public function getFilters(): Filter\MapInterface
    {
        return $this->getWhereFilterMap();
    }

    protected function getWhereFilterMap(): MapInterface
    {
        if ($this->filters == null) {
            $this->filters = $this->getWhereFilterMapFactory()->create();
        }

        return $this->filters;
    }
}
