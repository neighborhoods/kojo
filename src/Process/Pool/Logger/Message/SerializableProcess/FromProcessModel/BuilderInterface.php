<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcessInterface as ProcessInterfaceAlias;
use Neighborhoods\Kojo\ProcessInterface;

interface BuilderInterface
{
    public function build() : ProcessInterfaceAlias;

    public function getProcessModelInterface() : ProcessInterface;

    public function setProcessModelInterface(ProcessInterface $processInterface) : BuilderInterface;
}
