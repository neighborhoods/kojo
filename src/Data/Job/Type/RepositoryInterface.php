<?php

namespace NHDS\Jobs\Data\Job\Type;

use NHDS\Jobs\Data\Job\TypeInterface;

interface RepositoryInterface
{
    public function getJobType(string $typeCode): TypeInterface;

    public function getJobTypeClone(string $typeCode): TypeInterface;
}