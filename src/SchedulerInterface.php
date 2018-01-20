<?php
declare(strict_types=1);

namespace NHDS\Jobs;

use NHDS\Jobs\Scheduler\CacheInterface;
use NHDS\Jobs\Scheduler\TimeInterface;

interface SchedulerInterface
{
    const SEMAPHORE_RESOURCE_NAME_SCHEDULE = 'schedule';

    public function setSchedulerCache(CacheInterface $schedulerCache);

    public function setSchedulerTime(TimeInterface $schedulerTime);

    public function scheduleStaticJobs(): SchedulerInterface;
}
