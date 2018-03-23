<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service;

use NHDS\Jobs\Data\Job\Collection\ScheduleLimitInterface;
use NHDS\Jobs\ServiceInterface;
use NHDS\Jobs\Data\JobInterface;

interface CreateInterface extends ServiceInterface
{
    /** @injected:configuration */
    public function setJob(JobInterface $job);

    /** @injected:configuration */
    public function setJobCollectionScheduleLimit(ScheduleLimitInterface $jobCollectionScheduleLimit);

    public function setJobTypeCode(string $jobTypeCode): CreateInterface;

    public function setImportance(int $importance): CreateInterface;

    public function setWorkAtDateTime(\DateTime $workAtDateTime): CreateInterface;

    public function getJobId(): int;
}