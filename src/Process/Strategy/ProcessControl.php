<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Strategy;

use NHDS\Jobs\Process\StrategyInterface;

class ProcessControl implements StrategyInterface
{
    public function fork(): int
    {
        return pcntl_fork();
    }
}