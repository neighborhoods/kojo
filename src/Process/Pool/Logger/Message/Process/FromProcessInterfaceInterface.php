<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process;

use Neighborhoods\Kojo\ProcessInterface;

interface FromProcessInterfaceInterface
{
    public function setProcessInterface(ProcessInterface $processInterface) : FromProcessInterfaceInterface;
}
