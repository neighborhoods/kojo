<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): ProcessInterface;
}
