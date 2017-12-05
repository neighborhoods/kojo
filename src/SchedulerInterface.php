<?php

namespace NHDS\Jobs;

interface SchedulerInterface
{
    public function schedule(): SchedulerInterface;
}
