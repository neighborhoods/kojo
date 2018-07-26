<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Strategy;

use Neighborhoods\Kojo\Process\StrategyInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): StrategyInterface;
}
