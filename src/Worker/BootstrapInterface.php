<?php

namespace NHDS\Jobs\Worker;

use NHDS\Jobs\Db\Connection\ContainerInterface;

interface BootstrapInterface
{
    public function addDbConnectionContainer(ContainerInterface $container);

    public function instantiate(): BootstrapInterface;

    public function setPdo(\PDO $pdo): BootstrapInterface;
}