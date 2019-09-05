<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterfaceInterface;
use Neighborhoods\Kojo\ProcessInterface;

interface BuilderInterface
{
    public function build() : FromProcessInterfaceInterface;

    public function getProcessInterface() : ProcessInterface;

    public function setProcessInterface(ProcessInterface $processInterface) : BuilderInterface;
}
