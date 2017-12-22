<?php

namespace NHDS\Jobs;

use NHDS\Jobs\Data\Job\Service\Update;

interface ForemanInterface
{
    public function work(): ForemanInterface;

    public function setJobServiceUpdateWorkFactory(Update\Work\FactoryInterface $updateWorkFactory);

    public function setJobServiceUpdateCrashFactory(Update\Crash\FactoryInterface $updateCrashFactory);
}