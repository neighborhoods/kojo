<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\DBAL\Connection\DecoratorArray;

use Neighborhoods\Kojo\Doctrine\DBAL\Connection\DecoratorArrayInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): DecoratorArrayInterface
    {
        return $this->getDoctrineDBALConnectionDecoratorArray()->getArrayCopy();
    }
}
