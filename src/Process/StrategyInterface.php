<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

interface StrategyInterface
{
    public function fork(): int;
}