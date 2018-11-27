<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Map;

use Neighborhoods\Kojo\Where\Filter\Group\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}
