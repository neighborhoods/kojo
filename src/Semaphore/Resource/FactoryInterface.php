<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource;

use Neighborhoods\Kojo\Semaphore\ResourceInterface;

interface FactoryInterface
{
    public function create(): ResourceInterface;
}