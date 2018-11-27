<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter;

use Neighborhoods\Kojo\Where\FilterInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): FilterInterface
    {
        return clone $this->getWhereFilter();
    }
}
