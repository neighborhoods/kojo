<?php

namespace Neighborhoods\Kojo\Where\Filter\Builder;

use Neighborhoods\Kojo\Where\Filter\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getWhereFilterBuilder();
    }
}
