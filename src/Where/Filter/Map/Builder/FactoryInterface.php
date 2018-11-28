<?php

namespace Neighborhoods\Kojo\Where\Filter\Map\Builder;

use Neighborhoods\Kojo\Where\Filter\Map\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}
