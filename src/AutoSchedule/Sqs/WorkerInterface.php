<?php

namespace NHDS\Jobs\AutoSchedule\Sqs;

interface WorkerInterface
{
    public function work(): WorkerInterface;
}