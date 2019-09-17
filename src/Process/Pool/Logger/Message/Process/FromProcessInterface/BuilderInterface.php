<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessInterface;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\ProcessInterface as ProcessInterfaceAlias;
use Neighborhoods\Kojo\ProcessInterface;

interface BuilderInterface
{
    public function build() : ProcessInterfaceAlias;

    public function getProcessModelInterface() : ProcessInterface;

    public function setProcessModelInterface(ProcessInterface $processInterface) : BuilderInterface;
}
