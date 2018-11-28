<?php

namespace Neighborhoods\Kojo\Where\Builder;

use Neighborhoods\Kojo\Where\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}
