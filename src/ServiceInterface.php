<?php
declare(strict_types=1);

namespace NHDS\Jobs;

use NHDS\Jobs\Data\JobInterface;

interface ServiceInterface
{
    public function setStateService(State\ServiceInterface $jobStateService);

    public function setJob(JobInterface $job);

    public function save(): ServiceInterface;
}