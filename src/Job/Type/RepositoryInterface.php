<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Type;

use Neighborhoods\Kojo\Job\TypeInterface;

interface RepositoryInterface
{
    public function get(string $typeCode): TypeInterface;

    public function create(string $typeCode): TypeInterface;

    public function getAll(): MapInterface;
}