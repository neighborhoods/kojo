<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterfaceInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : FromProcessInterfaceInterface;
}
