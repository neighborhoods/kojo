<?php

namespace Neighborhoods\Kojo\Where\Filter\Map\Builder;

use Neighborhoods\Kojo\Where\Filter\Map\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getWhereFilterMapBuilder();
    }
}
