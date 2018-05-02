<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example\Worker;

use Neighborhoods\Kojo\Worker\BootstrapAbstract;
use Neighborhoods\Kojo\Worker\BootstrapInterface;

class Bootstrap extends BootstrapAbstract
{
    public function instantiate(): BootstrapInterface
    {
        $pdo = new \PDO('mysql:dbname=kojo;host=mysql', 'root', 'nhdsroot');
        $this->_setJobPdo($pdo);
        $this->_setSchemaPdo($pdo);

        return $this;
    }
}