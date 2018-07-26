<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy;

use Neighborhoods\Kojo\Process\Pool\StrategyInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): StrategyInterface
    {
        return clone $this->getProcessPoolStrategy();
    }
}
