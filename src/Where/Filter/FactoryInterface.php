<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter;

use Neighborhoods\Kojo\Where\FilterInterface;

interface FactoryInterface
{
    public function create(): FilterInterface;
}
