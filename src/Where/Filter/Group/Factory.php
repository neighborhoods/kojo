<?php

namespace Neighborhoods\Kojo\Where\Filter\Group;

use Neighborhoods\Kojo\Where\Filter\GroupInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): GroupInterface
    {
        return clone $this->getWhereFilterGroup();
    }
}
