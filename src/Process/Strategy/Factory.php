<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Strategy;

use Neighborhoods\Kojo\Process\StrategyInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): StrategyInterface
    {
        return clone $this->getProcessStrategy();
    }
}
