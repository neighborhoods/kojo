<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection\DecoratorArray;

use Neighborhoods\Kojo\Doctrine\Connection\DecoratorArrayInterface;

interface FactoryInterface
{
    public function create(): DecoratorArrayInterface;
}
