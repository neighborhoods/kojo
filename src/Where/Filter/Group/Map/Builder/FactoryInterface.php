<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Map\Builder;

use Neighborhoods\Kojo\Where\Filter\Group\Map\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}
