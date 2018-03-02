<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

use NHDS\Jobs\ProcessInterface;

interface RegistryInterface
{
    public function pushProcess(ProcessInterface $process): RegistryInterface;

    public function getLastRegisteredProcess(): ProcessInterface;
}