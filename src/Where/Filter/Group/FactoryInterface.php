<?php

namespace Neighborhoods\Kojo\Where\Filter\Group;

use Neighborhoods\Kojo\Where\Filter\GroupInterface;

interface FactoryInterface
{
    public function create(): GroupInterface;
}
