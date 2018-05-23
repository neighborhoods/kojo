<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection\Decorator;

use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;

interface FactoryInterface
{
    public function create() : DecoratorInterface;
}
