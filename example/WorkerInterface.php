<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example;

interface WorkerInterface
{
    public function work(): WorkerInterface;
}