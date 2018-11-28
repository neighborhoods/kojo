<?php

namespace Neighborhoods\Kojo\Where\SortOrder\Map\Builder;

use Neighborhoods\Kojo\Where\SortOrder\Map\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getWhereSortOrderMapBuilder();
    }
}
