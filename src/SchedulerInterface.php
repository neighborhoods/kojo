<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Scheduler\CacheInterface;

interface SchedulerInterface
{
    const SEMAPHORE_RESOURCE_NAME_SCHEDULE = 'schedule';

    public function setSchedulerCache(CacheInterface $schedulerCache);

    public function scheduleStaticJobs(): SchedulerInterface;
}