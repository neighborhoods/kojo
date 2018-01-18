<?php
declare(strict_types=1);

namespace NHDS\Jobs\Example\Worker;

use NHDS\Jobs\Db\Connection\ContainerInterface;
use NHDS\Jobs\Worker\BootstrapAbstract;
use NHDS\Jobs\Worker\BootstrapInterface;

class Bootstrap extends BootstrapAbstract
{
    public function instantiate(): BootstrapInterface
    {
        $pdo = new \PDO('mysql:dbname=jobs;host=mysql', 'root', 'nhdsroot');
        $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->setPdo($pdo);
        $this->_getDbConnectionContainer(ContainerInterface::NAME_SCHEMA)->setPdo($pdo);

        return $this;
    }
}