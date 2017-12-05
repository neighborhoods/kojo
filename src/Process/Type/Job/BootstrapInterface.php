<?php

namespace NHDS\Jobs\Process\Type\Job;

use NHDS\Jobs\Db\Connection\Container\ContainerInterface;

interface BootstrapInterface
{
    public function instantiate(): BootstrapInterface;

    public function addDbConnectionContainer(ContainerInterface $container);
}