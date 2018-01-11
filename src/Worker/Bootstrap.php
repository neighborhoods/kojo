<?php

namespace NHDS\Jobs\Worker;

class Bootstrap extends BootstrapAbstract
{
    public function instantiate(): BootstrapInterface
    {
        throw new \LogicException('Client application must define a Bootstrap class.');

        return $this;
    }
}