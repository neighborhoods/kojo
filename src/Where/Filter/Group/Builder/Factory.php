<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Builder;

use Neighborhoods\Kojo\Where\Filter\Group\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getWhereFilterGroupBuilder();
    }
}
