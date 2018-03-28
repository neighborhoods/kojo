<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service;

use Neighborhoods\Kojo\Data\Job\Collection\ScheduleLimitInterface;
use Neighborhoods\Kojo\ServiceInterface;
use Neighborhoods\Kojo\Data\JobInterface;

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