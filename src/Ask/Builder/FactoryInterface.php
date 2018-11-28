<?php

namespace Neighborhoods\Kojo\Ask\Builder;

use Neighborhoods\Kojo\Ask\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}
