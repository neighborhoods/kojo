<?php

namespace NHDS\Jobs\Example\Process\Pool\Type\Job;

use NHDS\Jobs\Process\Type\Job\BootstrapAbstract;
use NHDS\Jobs\Process\Type\Job\BootstrapInterface;

class BootstrapExample extends BootstrapAbstract
{
    public function instantiate(): BootstrapInterface
    {
        $pdo = new \PDO('mysql:dbname=jobs;host=mysql', 'root', 'nhdsroot');
        $this->_getDbConnectionContainer('job')->setPdo($pdo);

        return $this;
    }
}