<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\SortOrder;

use Neighborhoods\Kojo\Where\SortOrderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): SortOrderInterface
    {
        return clone $this->getWhereSortOrder();
    }
}
