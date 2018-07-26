<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessInterface;

interface RepositoryInterface
{

    public function create(string $id): ProcessInterface;

    public function getAll(): MapInterface;
}