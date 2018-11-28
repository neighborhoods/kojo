<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter;

use Neighborhoods\Kojo\Where\FilterInterface;
use Neighborhoods\Kojo\Where\Filter;

class Group implements GroupInterface
{
    use Filter\Map\AwareTrait;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function addFilter(FilterInterface $filter): GroupInterface
    {
        $this->getWhereFilterMap()[] = $filter;

        return $this;
    }

    public function getFilters(): Filter\MapInterface
    {
        return $this->getWhereFilterMap();
    }
}
