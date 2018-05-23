<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection\Decorator;

use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;
use Neighborhoods\Kojo\Doctrine;
use Neighborhoods\Pylon\Data;

class Factory implements FactoryInterface
{
    use AwareTrait;
    use Data\Property\Defensive\AwareTrait;

    public function create(): DecoratorInterface
    {
        return clone $this->_getdoctrineConnectionDecorator();
    }
}
