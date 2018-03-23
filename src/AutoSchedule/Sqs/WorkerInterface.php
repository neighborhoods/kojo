<?php
declare(strict_types=1);

namespace NHDS\Jobs\AutoSchedule\Sqs;

interface WorkerInterface
{
    public function work(): WorkerInterface;
}