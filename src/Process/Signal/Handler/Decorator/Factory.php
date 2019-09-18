<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Handler\Decorator;

use Neighborhoods\Kojo\Process\Signal\Handler\DecoratorInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): DecoratorInterface
    {
        return clone $this->getProcessSignalHandlerDecorator();
    }
}
