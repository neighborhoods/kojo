<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\ProcessInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : ProcessInterface;
}
