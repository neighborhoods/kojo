<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter\Map;

use Neighborhoods\Kojo\Where\Filter\MapInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getWhereFilterMap()->getArrayCopy();
    }
}
