<?php

namespace Neighborhoods\Kojo\Ask\Builder;

use Neighborhoods\Kojo\Ask\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getAskBuilder();
    }
}
