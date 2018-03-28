<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example\Worker;

use Neighborhoods\Kojo\Db\Connection\ContainerInterface;
use Neighborhoods\Kojo\Worker\BootstrapAbstract;
use Neighborhoods\Kojo\Worker\BootstrapInterface;

class Bootstrap extends BootstrapAbstract
{
    public function instantiate(): BootstrapInterface
    {
        $pdo = new \PDO('mysql:dbname=kojo;host=mysql', 'root', 'nhdsroot');
        $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->setPdo($pdo);
        $this->_getDbConnectionContainer(ContainerInterface::NAME_SCHEMA)->setPdo($pdo);

        return $this;
    }
}