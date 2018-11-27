<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where;

use Neighborhoods\Kojo\WhereInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): WhereInterface
    {
        return clone $this->getWhere();
    }
}
