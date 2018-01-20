<?php
declare(strict_types=1);

namespace NHDS\Jobs;

use NHDS\Jobs\Scheduler\CacheInterface;

interface SchedulerInterface
{
    const SEMAPHORE_RESOURCE_NAME_SCHEDULE = 'schedule';

    public function setSchedulerCache(CacheInterface $schedulerCache);

    public function scheduleStaticJobs(): SchedulerInterface;
}