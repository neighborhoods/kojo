<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessInterface;

interface RegistryInterface
{
    public function pushProcess(ProcessInterface $process): RegistryInterface;

    public function getLastRegisteredProcess(): ProcessInterface;
}