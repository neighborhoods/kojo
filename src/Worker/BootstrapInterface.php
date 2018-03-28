<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker;

use Neighborhoods\Kojo\Db\Connection\ContainerInterface;

interface BootstrapInterface
{
    public function addDbConnectionContainer(ContainerInterface $container);

    public function instantiate(): BootstrapInterface;

    public function setPdo(\PDO $pdo): BootstrapInterface;
}