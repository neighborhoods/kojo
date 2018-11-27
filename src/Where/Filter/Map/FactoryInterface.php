<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter\Map;

use Neighborhoods\Kojo\Where\Filter\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}
