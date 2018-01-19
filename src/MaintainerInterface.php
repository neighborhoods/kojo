<?php
declare(strict_types=1);

namespace NHDS\Jobs;

use NHDS\Jobs\Data\Job\Collection\ScheduleLimitInterface;

interface MaintainerInterface
{
    const SEMAPHORE_RESOURCE_NAME_RESCHEDULE_JOBS     = 'reschedule_jobs';
    const SEMAPHORE_RESOURCE_NAME_UPDATE_PENDING_JOBS = 'update_pending_jobs';

    public function rescheduleCrashedJobs(): MaintainerInterface;

    public function updatePendingJobs(): MaintainerInterface;

    public function setJobCollectionScheduleLimit(ScheduleLimitInterface $jobCollectionScheduleLimit);

    public function deleteCompletedJobs(): MaintainerInterface;
}