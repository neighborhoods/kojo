<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Connection\Container;

use Neighborhoods\Kojo\Db\Connection\ContainerInterface;

interface RepositoryInterface
{
    public function get(string $id): ContainerInterface;

    public function add(ContainerInterface $container): RepositoryInterface;

    public function create(string $id): ContainerInterface;
}