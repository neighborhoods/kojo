<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker;

class Bootstrap extends BootstrapAbstract
{
    public function instantiate(): BootstrapInterface
    {
        return $this;
    }
}