<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy;

use Neighborhoods\Kojo\Process\Pool\StrategyInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): StrategyInterface;
}
