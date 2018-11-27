<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Builder;

use Neighborhoods\Kojo\Where\Filter\Group\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}
