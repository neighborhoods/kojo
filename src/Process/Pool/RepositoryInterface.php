<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Process\PoolInterface;

interface RepositoryInterface
{
    public function get(string $id): PoolInterface;
}