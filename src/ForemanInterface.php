<?php

namespace NHDS\Jobs;

interface ForemanInterface
{
    const MAINTAIN_SEMAPHORE_RESOURCE_NAME = 'maintain';
    const SCHEDULE_SEMAPHORE_RESOURCE_NAME = 'schedule';

    public function work(): ForemanInterface;
}