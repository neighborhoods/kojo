<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Handler\Decorator;

use Neighborhoods\Kojo\Process\Signal\Handler\DecoratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): DecoratorInterface;
}
