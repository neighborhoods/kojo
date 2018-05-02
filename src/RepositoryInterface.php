<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

interface RepositoryInterface
{
    public function getById(string $id);
}