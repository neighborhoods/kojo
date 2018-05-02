<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Connection\Container;

use Neighborhoods\Kojo\Db\Connection\ContainerInterface;

interface FactoryInterface
{
    public function create(): ContainerInterface;

    public function setDbConnectionContainer(ContainerInterface $dbConnectionContainer);
}