<?php

namespace Neighborhoods\Kojo\Where\SortOrder\Builder;

use Neighborhoods\Kojo\Where\SortOrder\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}
