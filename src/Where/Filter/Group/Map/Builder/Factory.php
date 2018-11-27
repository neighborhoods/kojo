<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Map\Builder;

use Neighborhoods\Kojo\Where\Filter\Group\Map\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getWhereFilterGroupMapBuilder();
    }
}
