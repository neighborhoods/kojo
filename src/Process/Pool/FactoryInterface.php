<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Process\PoolInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): PoolInterface;
}
