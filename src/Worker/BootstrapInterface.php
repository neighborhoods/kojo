<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker;

interface BootstrapInterface
{
    public function instantiate(): BootstrapInterface;
}