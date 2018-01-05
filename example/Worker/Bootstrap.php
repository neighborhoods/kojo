<?php

namespace NHDS\Jobs\Example\Worker;

use NHDS\Jobs\Worker\BootstrapAbstract;
use NHDS\Jobs\Worker\BootstrapInterface;

class Bootstrap extends BootstrapAbstract
{
    public function instantiate(): BootstrapInterface
    {
        $pdo = new \PDO('mysql:dbname=jobs;host=mysql', 'root', 'nhdsroot');
        $this->_getDbConnectionContainer('job')->setPdo($pdo);

        return $this;
    }
}