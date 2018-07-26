<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\DBAL\Connection\DecoratorArray;

use Neighborhoods\Kojo\Doctrine\DBAL\Connection\DecoratorArrayInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): DecoratorArrayInterface;
}
