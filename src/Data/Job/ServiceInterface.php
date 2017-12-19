<?php

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\JobInterface;

interface ServiceInterface
{
    public function setJob(JobInterface $job);

    public function save();
}