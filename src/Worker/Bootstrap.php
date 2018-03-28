<?php
declare(strict_types=1);

namespace NHDS\Jobs\Worker;

class Bootstrap extends BootstrapAbstract
{
    public function instantiate(): BootstrapInterface
    {
        return $this;
    }
}