<?php

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\JobInterface;
use NHDS\Jobs\Data\Job;

interface ServiceInterface
{
    public function setJobStateService(Job\State\ServiceInterface $jobStateService);

    public function setJob(JobInterface $job);

    public function save(): ServiceInterface;
}