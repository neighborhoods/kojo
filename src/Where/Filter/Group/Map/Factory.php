<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Map;

use Neighborhoods\Kojo\Where\Filter\Group\MapInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return clone $this->getWhereFilterGroupMap();
    }
}
