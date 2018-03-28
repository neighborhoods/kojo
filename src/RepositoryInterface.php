<?php
declare(strict_types=1);

namespace NHDS\Jobs;

interface RepositoryInterface
{
    public function getById(string $id);
}