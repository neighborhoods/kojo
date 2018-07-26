<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis;

interface RepositoryInterface
{
    public function get(string $id): \Redis;
}