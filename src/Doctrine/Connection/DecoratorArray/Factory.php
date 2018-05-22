<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection\DecoratorArray;

use Neighborhoods\Kojo\Doctrine\Connection\DecoratorArrayInterface;
use Neighborhoods\Pylon\Data;

class Factory implements FactoryInterface
{
    use AwareTrait;
    use Data\Property\Defensive\AwareTrait;

    public function create(): DecoratorArrayInterface
    {
        return $this->_getdoctrineConnectionDecoratorArray()->getArrayCopy();
    }
}
