<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service;

use Neighborhoods\Kojo\Job\Collection\ScheduleLimitInterface;
use Neighborhoods\Kojo\ServiceInterface;
use Neighborhoods\Kojo\JobInterface;

interface CreateInterface extends ServiceInterface
{
    public function setJob(JobInterface $job);

    public function setJobTypeCode(string $jobTypeCode): CreateInterface;

    public function setImportance(int $importance): CreateInterface;

    public function setWorkAtDateTime(\DateTime $workAtDateTime): CreateInterface;

    public function getJobId(): int;
}