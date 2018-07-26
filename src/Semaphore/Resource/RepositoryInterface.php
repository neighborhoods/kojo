<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource;

use Neighborhoods\Kojo\Semaphore\ResourceInterface;

interface RepositoryInterface
{

    public function get(string $id): ResourceInterface;
}