<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job;

use Neighborhoods\Kojo\Service\CreateInterface;

interface SchedulerInterface
{
    public function setJobTypeCode(string $jobTypeCode): SchedulerInterface;

    public function setImportance(int $importance): SchedulerInterface;

    public function setWorkAtDateTime(\DateTime $workAtDateTime): SchedulerInterface;

    public function getJobId(): int;

    public function save(): SchedulerInterface;

    /** @injected:runtime */
    public function setServiceCreate(CreateInterface $serviceCreate);
}