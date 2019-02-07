<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Strategy;

use Neighborhoods\Kojo\Process\StrategyInterface;

class ProcessControl implements StrategyInterface
{
    public function fork(): int
    {
        return pcntl_fork();
    }
}
