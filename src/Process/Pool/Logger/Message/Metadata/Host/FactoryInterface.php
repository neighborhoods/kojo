<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\HostInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : HostInterface;
}
