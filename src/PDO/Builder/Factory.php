<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\PDO\Builder;

use Neighborhoods\Kojo\PDO\BuilderInterface;
use Neighborhoods\Pylon\Data;

class Factory implements FactoryInterface
{
    use AwareTrait;
    use Data\Property\Defensive\AwareTrait;

    public function create() : BuilderInterface
    {
        return clone $this->_getPDOBuilder();
    }
}
