<?php

namespace Neighborhoods\Kojo\Where\SortOrder\Map\Builder;

use Neighborhoods\Kojo\Where\SortOrder\Map\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}
