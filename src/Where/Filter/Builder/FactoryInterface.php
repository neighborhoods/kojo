<?php

namespace Neighborhoods\Kojo\Where\Filter\Builder;

use Neighborhoods\Kojo\Where\Filter\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}
