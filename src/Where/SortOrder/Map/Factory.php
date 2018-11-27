<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\SortOrder\Map;

use Neighborhoods\Kojo\Where\SortOrder\MapInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getWhereSortOrderMap()->getArrayCopy();
    }
}
