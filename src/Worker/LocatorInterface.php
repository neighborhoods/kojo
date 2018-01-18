<?php
declare(strict_types=1);

namespace NHDS\Jobs\Worker;

use NHDS\Jobs\Data\JobInterface;

interface LocatorInterface
{
    public function setJob(JobInterface $job);

    public function getCallable(): callable;
}