<?php

namespace Neighborhoods\Kojo\Where\Builder;

use Neighborhoods\Kojo\Where\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getWhereBuilder();
    }
}
