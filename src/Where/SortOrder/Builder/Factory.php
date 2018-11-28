<?php

namespace Neighborhoods\Kojo\Where\SortOrder\Builder;

use Neighborhoods\Kojo\Where\SortOrder\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getWhereSortOrderBuilder();
    }
}
