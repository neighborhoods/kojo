<?php
declare(strict_types=1);

namespace NHDS\Jobs\Redis;

use NHDS\Jobs\Process\RegistryInterface;

interface RepositoryInterface
{
    public function getById(string $id): \Redis;

    public function setRedisFactory(FactoryInterface $factory);

    public function setProcessRegistry(RegistryInterface $registry);
}