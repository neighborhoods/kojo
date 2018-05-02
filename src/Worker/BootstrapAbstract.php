<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker;

use Neighborhoods\Kojo\Db\Connection\ContainerInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Kojo\Db\Connection\Container;
use Neighborhoods\Kojo\Foreman;

abstract class BootstrapAbstract implements BootstrapInterface
{
    use Container\Repository\AwareTrait;
    use Foreman\AwareTrait;
    use Defensive\AwareTrait;

    abstract public function instantiate(): BootstrapInterface;

    protected function _setJobPdo(\PDO $pdo): BootstrapInterface
    {
        $this->_getDbConnectionContainerRepository()->get(ContainerInterface::ID_JOB)->setPdo($pdo);

        return $this;
    }

    protected function _setSchemaPdo(\PDO $pdo): BootstrapInterface
    {
        $this->_getDbConnectionContainerRepository()->get(ContainerInterface::ID_SCHEMA)->setPdo($pdo);

        return $this;
    }
}