<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter;

use Neighborhoods\Kojo\Where\FilterInterface;
use Neighborhoods\Kojo\Where\Filter;

interface GroupInterface extends \JsonSerializable
{
    public function addFilter(FilterInterface $filter): GroupInterface;

    public function getFilters(): Filter\MapInterface;

    public function setWhereFilterMap(MapInterface $whereFilterMap);
}
