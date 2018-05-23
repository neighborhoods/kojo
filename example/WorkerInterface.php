<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample;

interface WorkerInterface
{
    public function work(): WorkerInterface;
}