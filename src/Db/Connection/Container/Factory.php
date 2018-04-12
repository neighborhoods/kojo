<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Connection\Container;

use Neighborhoods\Kojo\Db\Connection\ContainerInterface;
use Neighborhoods\Kojo\Service\FactoryAbstract;
use Neighborhoods\Kojo\Db;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Db\Connection\Container\AwareTrait;

    public function create(): ContainerInterface
    {
        $dbConnectionContainer = $this->_getDbConnectionContainerClone();

        return $dbConnectionContainer;
    }
}