<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\DBAL\Connection\Decorator;

use Neighborhoods\Kojo\Doctrine\DBAL\Connection\DecoratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): DecoratorInterface;
}