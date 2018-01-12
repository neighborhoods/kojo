<?php

namespace NHDS\Jobs\Process;

interface StrategyInterface
{
    public function fork(): int;
}