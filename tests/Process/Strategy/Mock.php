<?php
declare(strict_types=1);

namespace NHDS\Jobs\Test\Process\Strategy;

use NHDS\Jobs\Process\StrategyInterface;

class Mock implements StrategyInterface
{
    public function fork(): int
    {
        return 12;
    }
}