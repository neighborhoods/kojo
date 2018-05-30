<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1;

interface WorkerInterface
{
    public function work(): WorkerInterface;
}