<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\AutoSchedule\Sqs;

interface WorkerInterface
{
    public function work(): WorkerInterface;
}