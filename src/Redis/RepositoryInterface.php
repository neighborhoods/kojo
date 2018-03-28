<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis;

use Neighborhoods\Kojo\Process\RegistryInterface;

interface RepositoryInterface
{
    public function getById(string $id): \Redis;

    public function setRedisFactory(FactoryInterface $factory);

    public function setProcessRegistry(RegistryInterface $registry);
}