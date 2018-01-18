<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

interface StrategyInterface
{
    public function fork(): int;
}