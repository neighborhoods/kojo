<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Type;

use Neighborhoods\Kojo\Data\Job\TypeInterface;

interface RepositoryInterface
{
    public function getJobType(string $typeCode): TypeInterface;

    public function getJobTypeClone(string $typeCode): TypeInterface;
}