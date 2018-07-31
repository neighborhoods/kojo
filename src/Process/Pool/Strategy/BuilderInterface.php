<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy;

use Neighborhoods\Kojo\Process\Pool\StrategyInterface;

interface BuilderInterface
{
    public function getIdentity(): string;

    public function build(): StrategyInterface;
}