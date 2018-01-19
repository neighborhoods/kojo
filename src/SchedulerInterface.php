<?php
declare(strict_types=1);

namespace NHDS\Jobs;

interface SchedulerInterface
{
    const SEMAPHORE_RESOURCE_NAME_SCHEDULE = 'schedule';

    public function scheduleStaticJobs(): SchedulerInterface;
}
