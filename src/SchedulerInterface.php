<?php

namespace NHDS\Jobs;

interface SchedulerInterface
{
    const SEMAPHORE_RESOURCE_NAME_SCHEDULE = 'schedule';

    public function schedule(): SchedulerInterface;
}
