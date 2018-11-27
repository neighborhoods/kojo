<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\SortOrder;

use Neighborhoods\Kojo\Where\SortOrderInterface;

interface FactoryInterface
{
    public function create(): SortOrderInterface;
}
