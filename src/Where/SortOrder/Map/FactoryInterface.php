<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\SortOrder\Map;

use Neighborhoods\Kojo\Where\SortOrder\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}
